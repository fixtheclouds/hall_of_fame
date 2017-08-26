yii.confirm = function (message, okCallback, cancelCallback) {
    bootbox.confirm(message, function (confirmed) {
        if (confirmed) {
            okCallback();
        } else {
            cancelCallback();
        }
    });
    return false;
};
