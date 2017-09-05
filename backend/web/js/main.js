yii.confirm = function (message, okCallback) {
    bootbox.confirm({
        message: message,
        buttons: {
            confirm: {
                label: 'ОК',
                className: 'btn-success'
            },
            cancel: {
                label: 'Отмена',
                className: 'btn-danger'
            }
        },
        callback: function (confirmed) {
            if (confirmed) {
                okCallback();
            }
        }
    });
    return false;
};
