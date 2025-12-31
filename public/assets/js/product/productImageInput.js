document.addEventListener('DOMContentLoaded', function () {
    const imageInput = document.getElementById('product_image_input');
    const addImageBox = document.getElementById('addImageBox');
    const imagesContainer = document.getElementById('imagesContainer');
    const removedImagesInput = document.getElementById('removedImages');
    let removedImages = [];
    let selectedFiles = new DataTransfer(); // Para manter controle dos arquivos

    if (addImageBox && imageInput) {
        // Clique no box de adicionar imagem
        addImageBox.addEventListener('click', function () {
            imageInput.click();
        });

        // Mudança no input de arquivo
        imageInput.addEventListener('change', function (e) {
            const files = e.target.files;

            if (files && files.length > 0) {
                Array.from(files).forEach(file => {
                    if (file.type.startsWith('image/')) {
                        // Adicionar arquivo ao DataTransfer
                        selectedFiles.items.add(file);
                        
                        const reader = new FileReader();
                        reader.onload = function (event) {
                            addImagePreview(event.target.result, file.name, null);
                        };
                        reader.readAsDataURL(file);
                    }
                });

                // Atualizar o input com os arquivos
                imageInput.files = selectedFiles.files;
            }
        });
    }

    // Função para adicionar preview de imagem
    window.addImagePreview = function (imageSrc, fileName, existingImageId) {
        const imageBox = document.createElement('div');
        imageBox.className = 'position-relative';
        imageBox.style.width = '150px';
        imageBox.style.height = '150px';
        imageBox.style.border = '3px solid #dee2e6';
        imageBox.style.borderRadius = '4px';

        imageBox.innerHTML = `
            <img src="${imageSrc}" 
                class="w-100 h-100"
                style="object-fit: cover; display: block; border-radius: 2px;">
            <button type="button" 
                class="btn btn-sm btn-danger position-absolute top-0 end-0"
                onclick="removeImagePreview(this${existingImageId ? ', ' + existingImageId : ''})"
                style="border-radius: 50%; width: 30px; height: 30px; padding: 0; display: flex; align-items: center; justify-content: center; margin: 3px;">
                <i class="bi bi-trash"></i>
            </button>
        `;

        // Inserir antes do box de adicionar
        imagesContainer.insertBefore(imageBox, addImageBox);
    };

    // Função para remover preview de imagem
    window.removeImagePreview = function (btn, existingImageId) {
        btn.closest('.position-relative').remove();

        // Se for uma imagem existente, marcar como removida
        if (existingImageId) {
            removedImages.push(existingImageId);
            removedImagesInput.value = JSON.stringify(removedImages);
        }
    };

    // Função para remover imagem existente (do backend)
    window.removeExistingImage = function (btn, imageId) {
        btn.closest('.position-relative').remove();
        removedImages.push(imageId);
        removedImagesInput.value = JSON.stringify(removedImages);
    };
});
