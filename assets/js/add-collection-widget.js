var jQuery = require('jquery');
jQuery(document).ready(function () {
    jQuery('.add-another-collection-widget').click(function (e) {
        e.preventDefault();
        var list = jQuery(jQuery(this).attr('data-list'));
        // Попробуйте найти Try to find the счётчик списка
        var counter = list.data('widget-counter') | list.children().length;
        // Если счётчик не существует, используйте длину списка
        if (!counter) {
            counter = list.children().length;
        }

        // получите прототип шаблона
        var newWidget = list.attr('data-prototype');
        // замените "__name__", используемое в id и названии прототипа
        // числом, уникальным для ваших электронных адресов
        // конечное имя атрибута выглядт как name="contact[emails][2]"
        newWidget = newWidget.replace(/__name__/g, counter);
        // Увеличьте счётчик
        counter++;
        // И сохраните его, длина не может быть использована, если разрешено удаление виджетов
        list.data(' widget-counter', counter);

        // создайте новый элемент списка и добавьте его в список
        var newElem = jQuery(list.attr('data-widget-tags')).html(newWidget);
        newElem.appendTo(list);
    });
});