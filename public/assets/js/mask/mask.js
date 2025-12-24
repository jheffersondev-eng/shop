$(document).ready(function() {
    maskPhone();
    maskDocument();
});

// ==================== DEFINIR MÁSCARAS ====================

function maskPhone() {
    const config = {
        class: '.phone-mask',
        format: '(00) 00000-0000',
        maxLength: 14
    };
    applyMask(config);
}

function maskDocument() {
    const config = {
        class: '.document-mask',
        formats: ['000.000.000-00', '00.000.000/0000-00'],
        maxLength: 14
    };
    applyMask(config);
}

// ==================== FUNÇÃO GENÉRICA DE MÁSCARA ====================

function applyMask(config) {
    const { class: selector, format, formats, maxLength } = config;

    // Aplicar máscara ao digitar
    $(document).on('input', selector, function() {
        const cursorPosition = this.selectionStart;
        const oldValue = $(this).val();
        let onlyNumbers = oldValue.replace(/\D/g, '');

        // Se o campo está vazio, deixar vazio
        if (onlyNumbers.length === 0) {
            $(this).val('');
            return;
        }

        // Limitar ao tamanho máximo
        if (maxLength) {
            onlyNumbers = onlyNumbers.slice(0, maxLength);
        }

        // Escolher formato se for array
        let selectedFormat = format;
        if (formats && Array.isArray(formats)) {
            // CPF tem até 11 dígitos, CNPJ tem 14
            selectedFormat = onlyNumbers.length <= 11 ? formats[0] : formats[1];
        }

        // Verificar se selectedFormat existe antes de usar
        if (!selectedFormat) {
            $(this).val(onlyNumbers);
            return;
        }

        const newValue = formatValue(onlyNumbers, selectedFormat);
        $(this).val(newValue);

        // Ajustar posição do cursor
        const diff = newValue.length - oldValue.length;
        this.setSelectionRange(cursorPosition + diff, cursorPosition + diff);
    });

    // Aplicar máscara a valores pré-preenchidos
    $(selector).each(function() {
        if ($(this).val()) {
            let onlyNumbers = $(this).val().replace(/\D/g, '');
            let selectedFormat = format;
            
            if (formats && Array.isArray(formats)) {
                selectedFormat = onlyNumbers.length <= 11 ? formats[0] : formats[1];
            }

            if (!selectedFormat) {
                $(this).val(onlyNumbers);
                return;
            }
            
            $(this).val(formatValue(onlyNumbers, selectedFormat));
        }
    });
}

// ==================== FUNÇÃO QUE FORMATA O VALOR ====================

function formatValue(value, format) {
    // Contar quantos dígitos (0) são necessários na máscara
    const digitCount = (format.match(/0/g) || []).length;
    
    // Se não tiver dígitos suficientes, retornar sem formatação
    if (value.length < digitCount) {
        return value;
    }

    let formattedValue = '';
    let valueIndex = 0;

    for (let i = 0; i < format.length; i++) {
        if (format[i] === '0') {
            // Se for '0', é um dígito
            if (valueIndex < value.length) {
                formattedValue += value[valueIndex];
                valueIndex++;
            } else {
                break;
            }
        } else {
            // Caracteres literais (., -, /, (, ), etc)
            formattedValue += format[i];
        }
    }

    return formattedValue;
}
