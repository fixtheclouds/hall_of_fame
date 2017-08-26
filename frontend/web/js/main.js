yii.confirm = function (message, okCallback) {
    bootbox.confirm(message, function (confirmed) {
        if (confirmed) {
            okCallback();
        }
    });
    return false;
};
