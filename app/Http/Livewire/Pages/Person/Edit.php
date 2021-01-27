<?php

namespace App\Http\Livewire\Pages\Person;

use Livewire\Component;
use App\Http\Livewire\Traits\HasValidation;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Livewire\Traits\Notifies;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use HasValidation, Notifies, WithFileUploads;

    /**
     * The person.
     * 
     * @var Model
     */
    public $person;

    /**
     * The picture data.
     * 
     * @var string
     */
    public $picture;

    /**
     * The original picture.
     * 
     * @var string
     */
    public $original_picture;

    /**
     * The original thumbnail.
     * 
     * @var string
     */
    public $original_thumbnail;

    /**
     * The validation rules applied to the
     * properties.
     * 
     * @var array
     */
    public $rules = [
        'person.first_name' => 'required|string',
        'person.last_name' => 'required|string',
        'person.entry_date' => 'required|date',
        'person.birth_date' => 'required|date',
        'picture' => 'nullable|image',
        'person.picture' => 'nullable|string'
    ];

    /**
     * Creates the component.
     * 
     * @return void
     */
    public function mount($id)
    {
        $this->person = config('models.person')::findOrFail($id);
        $this->original_picture = $this->person->picture;
        $this->original_thumbnail = $this->person->thumbnail;

        // Configure the email rule to except the id we're updating.
        $this->rules['person.email'] = 'required|email|unique:people,email,' . $this->person->id;
    }

    /**
     * Renders the component.
     * 
     * @return View
     */
    public function render()
    {
        return view('livewire.pages.person.edit');
    }

    /**
     * Edit the person with the new data.
     * 
     * @return void
     */
    public function save()
    {
        $data = $this->validate();

        // If the user uploaded a new picture, store it and change the reference.
        if ($this->picture) {
            // Upload the picture to the pictures folder and update the reference.
            $name = $this->uploadPicture();
            $data['picture'] = $name;

            // Unset the actual person's picture.
            unset($data['person.picture']);

            // Delete the current picture and the thumbnail from the folder.
            Storage::delete('\/pictures\/' . $this->person->picture);
            Storage::delete('\/pictures\/' . $this->person->thumbnail);
        } else if (is_null($this->person->picture)) {
            // Delete the original picture and thumbnail if the user did not update a new one and deleted the original.
            Storage::delete('\/pictures\/' . $this->original_picture);
            Storage::delete('\/pictures\/' . $this->original_thumbnail);
        } else {
            // Leave data as it is.
            unset($data['person.picture']);
            unset($data['picture']);
        }

        // Create the user with the validated information.
        $this->person->update($data);

        // Redirect and notify.
        $this->redirectAndNotify(route('people.index'), "{$this->person->full_name} edited successfully");
    }

    /**
     * Remove uploaded the picture.
     * 
     * @return void
     */
    public function removePicture()
    {
        $this->picture = null;
        $this->person->picture = null;
        $this->person->thumbnail = null;
    }

    /**
     * Uploads the user picture to the public folder
     * and returns the picture's name.
     * 
     * @return string
     */
    private function uploadPicture()
    {
        // Save original file.
        $name = (string) Str::uuid() . ".{$this->picture->extension()}";
        $this->picture->storeAs('pictures', $name);

        // Save thumbnail.
        Image::make($this->picture)
            ->resize(null, 150, function($constraint) {
                $constraint->aspectRatio();
            })
            ->save("storage/pictures/tmb_{$name}");

        return $name;
    }
}
