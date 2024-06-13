document.addEventListener('DOMContentLoaded', function() {
    // Basic message
    var messageElement = document.querySelector('.widget-content .message');

    if (messageElement) {
        messageElement.addEventListener('click', function() {
            Swal.fire('Saved successfully')
        });
    }

    /**
     *     Placement
     */

    // Center
    var defaultElement = document.querySelector('.widget-content .default');
    if (defaultElement) {
        defaultElement.addEventListener('click', function() {
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Placement set at default (center)',
                showConfirmButton: false,
                timer: 1500
            })
        });
    }

    // Top Start
    var topStartElement = document.querySelector('.widget-content .top-start');
    if (topStartElement) {
        topStartElement.addEventListener('click', function() {
            Swal.fire({
                position: 'top-start',
                icon: 'success',
                title: 'Placement set at top left',
                showConfirmButton: false,
                timer: 1500
            })
        });
    }

    // Top End
    var topEndElement = document.querySelector('.widget-content .top-end');
    if (topEndElement) {
        topEndElement.addEventListener('click', function() {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Placement set at top right',
                showConfirmButton: false,
                timer: 1500
            })
        });
    }

    // Bottom Start
    var bottomStartElement = document.querySelector('.widget-content .bottom-start');
    if (bottomStartElement) {
        bottomStartElement.addEventListener('click', function() {
            Swal.fire({
                position: 'bottom-start',
                icon: 'success',
                title: 'Placement set at bottom left',
                showConfirmButton: false,
                timer: 1500
            })
        });
    }

    // Bottom End
    var bottomEndElement = document.querySelector('.widget-content .bottom-end');
    if (bottomEndElement) {
        bottomEndElement.addEventListener('click', function() {
            Swal.fire({
                position: 'bottom-end',
                icon: 'success',
                title: 'Placement set at bottom right',
                showConfirmButton: false,
                timer: 1500
            })
        });
    }

    /**
     *       Auto Timer
     */
    var timerElement = document.querySelector('.widget-content .timer');
    if (timerElement) {
        timerElement.addEventListener('click', function() {
            let timerInterval
            Swal.fire({
                title: 'Auto close alert!',
                html: 'I will close in <b></b> milliseconds.',
                timer: 2000,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading()
                    const b = Swal.getHtmlContainer().querySelector('b')
                    timerInterval = setInterval(() => {
                        b.textContent = Swal.getTimerLeft()
                    }, 100)
                },
                willClose: () => {
                    clearInterval(timerInterval)
                }
            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.timer) {
                    console.log('I was closed by the timer')
                }
            })
        });
    }

    /**
     *     Message with custom image
     */
    var customImageElement = document.querySelector('.widget-content .custom-image');
    if (customImageElement) {
        customImageElement.addEventListener('click', function() {
            Swal.fire({
                title: 'Sweet!',
                text: 'Modal with a custom image.',
                imageUrl: '../src/assets/img/sweet-alert.jpg',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        });
    }

    /**
     *     Warning message, with "Confirm" button
     */
    var warningConfirmElement = document.querySelector('.widget-content .warning.confirm');
    if (warningConfirmElement) {
        warningConfirmElement.addEventListener('click', function() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })
        });
    }

    /**
     *     Execute something else for "Cancel".
     */
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    });

    var warningCancelElement = document.querySelector('.widget-content .warning.cancel');
    if (warningCancelElement) {
        warningCancelElement.addEventListener('click', function() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    swalWithBootstrapButtons.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your imaginary file is safe :)',
                        'error'
                    )
                }
            })
        });
    }

    /**
     *     RTL Support
     */
    var rtlElement = document.querySelector('.widget-content .RTL');
    if (rtlElement) {
        rtlElement.addEventListener('click', function() {
            Swal.fire({
                title: 'هل تريد الاستمرار؟',
                icon: 'question',
                iconHtml: '؟',
                confirmButtonText: 'نعم',
                cancelButtonText: 'لا',
                showCancelButton: true,
                showCloseButton: true
            })
        });
    }

    /**
     *     Mixin
     */
    var mixinElement = document.querySelector('.widget-content .mixin');
    if (mixinElement) {
        mixinElement.addEventListener('click', function() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'bottom-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            Toast.fire({
                icon: 'success',
                title: 'Signed in successfully'
            });
        });
    }

    /**
     *     Icons Type
     */

    // Success
    var iconSuccessElement = document.querySelector('.widget-content .icon-success');
    if (iconSuccessElement) {
        iconSuccessElement.addEventListener('click', function() {
            Swal.fire({
                icon: 'success',
                title: 'Icon Success',
            })
        });
    }

    // Error
    var iconErrorElement = document.querySelector('.widget-content .icon-error');
    if (iconErrorElement) {
        iconErrorElement.addEventListener('click', function() {
            Swal.fire({
                icon: 'error',
                title: 'Icon Error',
            })
        });
    }

    // Warning
    var iconWarningElement = document.querySelector('.widget-content .icon-warning');
    if (iconWarningElement) {
        iconWarningElement.addEventListener('click', function() {
            Swal.fire({
                icon: 'warning',
                title: 'Icon Warning',
            })
        });
    }

    // Info
    var iconInfoElement = document.querySelector('.widget-content .icon-info');
    if (iconInfoElement) {
        iconInfoElement.addEventListener('click', function() {
            Swal.fire({
                icon: 'info',
                title: 'Icon Info',
            })
        });
    }

    // Question
    var iconQuestionElement = document.querySelector('.widget-content .icon-question');
    if (iconQuestionElement) {
        iconQuestionElement.addEventListener('click', function() {
            Swal.fire({
                icon: 'question',
                title: 'Icon Question',
            })
        });
    }
});
