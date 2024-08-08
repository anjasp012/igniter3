(function($) {
    $.createModal = function(options) {
        // Default options
        var settings = $.extend({
            title: "",
            message: "Your Message Goes Here!",
            scrollable: false,
            onClose: null
        }, options);

        // Create modal HTML
        var modalHtml = `
            <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                <div class="modal-dialog full_modal-dialog ${settings.scrollable ? 'modal-dialog-scrollable' : ''}">
                    <form class="modal-content full_modal-content">
                        <div class="modal-header">
                            ${settings.title ? `<h5 class="modal-title">${settings.title}</h5>` : ''}
                            <button type="button" class="close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            ${settings.message}
                        </div>
                    </form>
                </div>
            </div>
        `;

        // Append modal HTML to the body and show the modal
        $('body').append(modalHtml);
        var $modal = $('#Modal').modal();

        // Event listener for modal close

        // Handle close button click
        $('.close').on('click', function(e) {
            e.preventDefault();
            window.parent.postMessage('closeModal', '*');
        });

        $('.modal-backdrop').on('click', function(e) {
            console.log('adadad');

            e.preventDefault();
            window.parent.postMessage('closeModal', '*');
        })
    };
})(jQuery);
