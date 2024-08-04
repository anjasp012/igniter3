(function($) {
    $.createModal = function(options) {
        // Default options
        var settings = $.extend({
            title: "",
            message: "Your Message Goes Here!",
            closeButton: false,
            editButton: false,
            deleteButton: false,
            scrollable: false
        }, options);

        // Create modal HTML
        var modalHtml = `
            <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                <div class="modal-dialog full_modal-dialog ${settings.scrollable ? 'modal-dialog-scrollable' : ''}">
                    <form class="modal-content full_modal-content">
                        <div class="modal-header">
                            ${settings.title ? `<h5 class="modal-title">${settings.title}</h5>` : ''}
                            ${settings.closeButton ? '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>' : ''}
                        </div>
                        <div class="modal-body">
                            ${settings.message}
                        </div>
                        ${(settings.closeButton || settings.editButton || settings.deleteButton) ? `
                            <div class="modal-footer">
                                ${settings.closeButton ? '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>' : ''}
                                ${settings.editButton ? '<button type="button" class="btn btn-primary">Edit</button>' : ''}
                                ${settings.deleteButton ? '<button type="button" class="btn btn-danger">Delete</button>' : ''}
                            </div>
                        ` : ''}
                    </form>
                </div>
            </div>
        `;

        // Append modal HTML to the body and show the modal
        $('body').append(modalHtml);
        $('#Modal').modal().on('hidden.bs.modal', function() {
            $(this).remove();
        });
    };
})(jQuery);
