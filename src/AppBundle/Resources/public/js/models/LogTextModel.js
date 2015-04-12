var LogTextModel;
$(function () {
    LogTextModel = Backbone.Model.extend({
        fetchModelByLogId: function (id) {
            var model = this;
            $.ajax({
                url: Routing.generate('ws_log_text_read', {'logId': id}),
                success: function (data) {
                    model.set(data);
                },
                error: function (data) {
                    model.set({text: 'Error loading data: ' + data.statusText});
                }
            });
        }
    });
});