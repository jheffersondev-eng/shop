document.getElementById('company_logo_input').addEventListener('change', function (e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (event) {
            document.getElementById('companyLogoPreview').src = event.target.result;
        };
        reader.readAsDataURL(file);
    }
});

const bannerInput = document.getElementById('image_banner');
const bannerPreview = document.getElementById('companyBannerPreview');
const bannerPlaceholder = document.getElementById('companyBannerPlaceholder');
const bannerCropModalEl = document.getElementById('bannerCropModal');
const bannerCropImage = document.getElementById('bannerCropImage');
const confirmBannerCrop = document.getElementById('confirmBannerCrop');
let bannerCropper = null;
let bannerModal = null;

if (bannerCropModalEl && typeof bootstrap !== 'undefined') {
    bannerModal = new bootstrap.Modal(bannerCropModalEl);

    bannerCropModalEl.addEventListener('shown.bs.modal', function () {
        if (!bannerCropImage || !bannerCropImage.src) return;
        if (bannerCropper) bannerCropper.destroy();
        bannerCropper = new Cropper(bannerCropImage, {
            aspectRatio: 3 / 1,
            viewMode: 2,
            autoCropArea: 1,
            background: false,
            responsive: true,
        });
    });

    bannerCropModalEl.addEventListener('hidden.bs.modal', function () {
        if (bannerCropper) {
            bannerCropper.destroy();
            bannerCropper = null;
        }
        if (bannerCropImage) {
            bannerCropImage.src = '';
        }
    });
}

if (bannerInput) {
    bannerInput.addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = function (event) {
            if (!bannerCropImage || !bannerModal) {
                if (bannerPreview) {
                    bannerPreview.src = event.target.result;
                    bannerPreview.style.display = 'block';
                }
                if (bannerPlaceholder) bannerPlaceholder.style.display = 'none';
                return;
            }

            bannerCropImage.src = event.target.result;
            bannerModal.show();
        };
        reader.readAsDataURL(file);
    });
}

if (confirmBannerCrop) {
    confirmBannerCrop.addEventListener('click', function () {
        if (!bannerCropper || !bannerInput) return;

        const canvas = bannerCropper.getCroppedCanvas({
            width: 1200,
            height: 400,
        });

        canvas.toBlob(function (blob) {
            if (!blob) return;

            const file = new File([blob], 'banner.jpg', { type: 'image/jpeg' });
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);
            bannerInput.files = dataTransfer.files;

            if (bannerPreview) {
                bannerPreview.src = URL.createObjectURL(blob);
                bannerPreview.style.display = 'block';
            }
            if (bannerPlaceholder) bannerPlaceholder.style.display = 'none';

            if (bannerModal) bannerModal.hide();
        }, 'image/jpeg', 0.9);
    });
}

// Auto-resize e contador para descrição
function autoResizeDescription() {
    const textarea = document.getElementById('description');
    textarea.style.height = 'auto';
    textarea.style.height = (textarea.scrollHeight) + 'px';
}
function updateDescriptionCount() {
    const textarea = document.getElementById('description');
    const count = textarea.value.length;
    document.getElementById('description-count').innerText = count;
    if (count > 255) {
        textarea.value = textarea.value.substring(0, 255);
        document.getElementById('description-count').innerText = 255;
    }
}
document.addEventListener('DOMContentLoaded', function () {
    autoResizeDescription();
    updateDescriptionCount();
    document.getElementById('description').addEventListener('input', function () {
        autoResizeDescription();
        updateDescriptionCount();
    });
});

const zipInput = document.getElementById('zip_code');
const stateInput = document.getElementById('state');
const cityInput = document.getElementById('city');
const streetInput = document.getElementById('street');
const neighborhoodInput = document.getElementById('neighborhood');

function setAddressFieldsEnabled(enabled) {
    streetInput.readOnly = !enabled;
    neighborhoodInput.readOnly = !enabled;
}

function clearAddressFields() {
    stateInput.value = '';
    cityInput.value = '';
    streetInput.value = '';
    neighborhoodInput.value = '';
    setAddressFieldsEnabled(true);
}

function setZipError(show, message = 'CEP não encontrado ou inválido!') {
    if (show) {
        zipInput.classList.add('is-invalid');
        if (!document.getElementById('zip-error')) {
            const div = document.createElement('div');
            div.className = 'invalid-feedback';
            div.id = 'zip-error';
            div.innerText = message;
            zipInput.parentNode.appendChild(div);
        }
    } else {
        zipInput.classList.remove('is-invalid');
        const div = document.getElementById('zip-error');
        if (div) div.remove();
    }
}

zipInput.addEventListener('blur', function () {
    const cep = zipInput.value.replace(/\D/g, '');
    if (cep.length !== 8) {
        clearAddressFields();
        setZipError(true, 'Digite um CEP válido com 8 dígitos.');
        return;
    }
    setZipError(false);
    fetch(`https://viacep.com.br/ws/${cep}/json/`)
        .then(response => response.json())
        .then(data => {
            if (data.erro) {
                clearAddressFields();
                setZipError(true);
                return;
            }
            stateInput.value = data.uf || '';
            cityInput.value = data.localidade || '';
            streetInput.value = data.logradouro || '';
            neighborhoodInput.value = data.bairro || '';
            setAddressFieldsEnabled(true);
            setZipError(false);
        })
        .catch(() => {
            clearAddressFields();
            setZipError(true);
        });
});

setAddressFieldsEnabled(true);