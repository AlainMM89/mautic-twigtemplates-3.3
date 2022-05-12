
Mautic.twigTemplatesOnLoad = function (container) {
};

Mautic.reloadTwigTemplatesExample = function (el) {
    Mautic.ajaxActionRequest('plugin:twigTemplates:generateExample', mQuery(el).parents('form').formToArray(), function (response) {
        if(response.content) {
            mQuery('#twigTemplateExample').html(response.content);
        }else{
            mQuery('#twigTemplateExample').html('');
        }
    }, true);
}

