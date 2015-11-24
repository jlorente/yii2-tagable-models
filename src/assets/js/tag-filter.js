/**
 * @author      José Lorente <jose.lorente.martin@gmail.com>
 * @license     The MIT License (MIT)
 * @copyright   José Lorente
 * @version     1.0
 */

(function (_w, $) {
    $('.tag-select-filter select').on('change', function () {
        var $this = $(this);
        var url = $this.data('url');
        if (url !== undefined && url !== null) {
            var tag = $this.val();
            if (tag.length > 0) {
                url += '/' + tag;
            }
            _w.location.href = url;
        }
    });
})(window, jQuery);