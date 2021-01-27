<?php

namespace App\Http\Livewire\Pages\Person;

use Livewire\Component;
use App\Http\Livewire\Traits\HasValidation;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Livewire\Traits\Notifies;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class Create extends Component
{
    use HasValidation, Notifies, WithFileUploads;

    /**
     * The first name.
     * 
     * @var string
     */
    public $first_name;

    /**
     * The last name.
     * 
     * @var string
     */
    public $last_name;

    /**
     * The entry date.
     * 
     * @var date
     */
    public $entry_date;

    /**
     * The birth date.
     * 
     * @var date
     */
    public $birth_date;

    /**
     * The picture.
     * 
     * @var string
     */
    public $picture;

    /**
     * The validation rules applied to the
     * properties.
     * 
     * @var array
     */
    public $rules = [
        'first_name' => 'required|string',
        'last_name' => 'required|string',
        'entry_date' => 'required|date',
        'birth_date' => 'required|date',
        'picture' => 'nullable|image',
    ];

    /**
     * Renders the component.
     * 
     * @return View
     */
    public function render()
    {
        return view('livewire.pages.person.create');
    }

    /**
     * Create the person with the given data.
     * 
     * @return void
     */
    public function save()
    {
        $data = $this->validate();

        // Upload the picture to the pictures folder and update the reference.
        if ($this->picture) {
            $name = $this->uploadPicture();
            $data['picture'] = $name;
        }

        // Create the user with the validated information.
        $person = config('models.person')::create($data);

        // Redirect and notify.
        $this->redirectAndNotify(route('people.index'), "{$person->full_name} created successfully");
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
