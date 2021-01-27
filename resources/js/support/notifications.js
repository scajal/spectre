/**
 * This module handles the incoming notifications
 * that must be shown.
 */

// Listen for the notification event.
window.addEventListener('notification', event => showNotification(event.detail.message));

// Show any pending notifications on page load.
window.addEventListener('page:load', () => {
    if (message = getPendingNotification()) {
        showNotification(message);
    }
});

// Listen for the redirection with notification event.
window.addEventListener('notification:redirect', event => {
    saveNotification(event.detail.message);
    window.dispatchEvent(new CustomEvent('page:redirect', {
        detail : { ...event.detail }
    }))
});

/**
 * Shows a snacbkar notification with 
 * the given message.
 * 
 * @param {string} message
 * @return {void}
 */

const showNotification = message => {
    window.Snackbar.show({
        pos: 'bottom-center',
        text: message
    });
};

/**
 * Returns the pending notification from the buffer and
 * also removes it.
 * 
 * @return {string|null}
 */

const getPendingNotification = () => {
    const message = localStorage.getItem('notification');
    localStorage.removeItem('notification');

    return message;
}

/**
 * Saves a notification as pending in the buffer.
 * 
 * @param {string} message
 * @return {void}
 */

const saveNotification = message => localStorage.setItem('notification', message);