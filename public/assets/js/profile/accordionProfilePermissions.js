$(document).ready(function () {
    // Função para atualizar o estado do botão "Marcar Todos"
    function updateMarkAllButtonState(moduleIndex) {
        const $checkboxes = $('input.permission-checkbox[data-module="' + moduleIndex + '"]');
        const totalCheckboxes = $checkboxes.length;
        const checkedCheckboxes = $checkboxes.filter(':checked').length;
        const $markAllBtn = $('button.mark-all-btn[data-module="' + moduleIndex + '"]');

        if (totalCheckboxes > 0 && checkedCheckboxes === totalCheckboxes) {
            // Todos estão marcados
            $markAllBtn.removeClass('btn-outline-primary').addClass('btn-primary');
            $markAllBtn.find('i').removeClass('bi-check2-all').addClass('bi-check-circle-fill');
        } else {
            // Nem todos estão marcados ou nenhum está marcado
            $markAllBtn.removeClass('btn-primary').addClass('btn-outline-primary');
            $markAllBtn.find('i').removeClass('bi-check-circle-fill').addClass('bi-check2-all');
        }
    }

    // Inicializar estado dos botões ao carregar a página
    $('button.mark-all-btn').each(function () {
        const moduleIndex = $(this).data('module');
        updateMarkAllButtonState(moduleIndex);
    });

    // Atualizar ícone do chevron quando accordion muda
    $(document).on('show.bs.collapse', '.permission-block', function (e) {
        const $toggle = $(this).find('.permission-toggle');
        $toggle.find('i').removeClass('bi-chevron-right').addClass('bi-chevron-down');
    });

    $(document).on('hide.bs.collapse', '.permission-block', function (e) {
        const $toggle = $(this).find('.permission-toggle');
        $toggle.find('i').removeClass('bi-chevron-down').addClass('bi-chevron-right');
    });

    // Botão "Marcar Todos"
    $(document).on('click', '.mark-all-btn', function (e) {
        e.preventDefault();
        const moduleIndex = $(this).data('module');
        const $checkboxes = $('input.permission-checkbox[data-module="' + moduleIndex + '"]');

        // Se todos estão marcados, desmarcar todos; senão, marcar todos
        const allChecked = $checkboxes.length === $checkboxes.filter(':checked').length;
        $checkboxes.prop('checked', !allChecked);

        // Atualizar estado do botão
        updateMarkAllButtonState(moduleIndex);
    });

    // Atualizar estado do botão quando um checkbox muda
    $(document).on('change', 'input.permission-checkbox', function () {
        const moduleIndex = $(this).data('module');
        updateMarkAllButtonState(moduleIndex);
    });

    // Apenas uma categoria expandida por vez
    $('.permissions-accordion').on('show.bs.collapse', '.permission-block', function () {
        $('.permission-block .collapse.show').collapse('hide');
    });
});