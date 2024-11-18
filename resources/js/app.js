import './bootstrap';

// Check for jQuery
if (typeof jQuery !== 'undefined') {
  console.log('jQuery version:', jQuery.fn.jquery);
} else {
  console.error('jQuery is not installed.');
}

// Check Bootstrap version using Bootstrap's JavaScript object
if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
  console.log('Bootstrap version:', bootstrap.Tooltip.VERSION);
} else {
  console.error('Bootstrap is not installed.');
}
