$(document).ready(function() {
    const $profileImageInput = $('#profile_image_input');
    const $profileImage = $('#profileImage');

    // Clique na imagem abre o seletor
    $profileImage.on('click', function() {
        $profileImageInput.click();
    });

    // Quando arquivo é selecionado
    $profileImageInput.on('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            // Atualizar preview da imagem
            const reader = new FileReader();
            reader.onload = function(event) {
                $profileImage.attr('src', event.target.result);
            };
            reader.readAsDataURL(file);
        }
    });
});
