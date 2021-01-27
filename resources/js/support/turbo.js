/**
 * This module handles the Turbo package that will help
 * navigate the application as if we are in a SPA.
 */

// Show the progreess bar on every page change.
window.Turbo.setProgressBarDelay(0);

// Emit a custom event on page load.
document.addEventListener('turbo:load', () => window.dispatchEvent(new CustomEvent('page:load')));

// Listen for the redirection event.
window.addEventListener('page:redirect', event => window.Turbo.visit(event.detail.url));