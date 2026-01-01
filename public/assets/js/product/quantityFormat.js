const DECIMAL = '1';
const INTEGER = '2';

$(document).ready(function () {
    const $unitSelect = $('#unit_id');
    const $stockQuantity = $('#stock_quantity');
    const $minQuantity = $('#min_quantity');

    /**
     * Obtém o formato da unidade selecionada
     */
    function getFormat() {
        return String($unitSelect.find('option:selected').attr('data-rule') || DECIMAL).trim();
    }

    /**
     * Verifica se o formato é inteiro
     */
    function isInteger() {
        return getFormat() === INTEGER || getFormat() === '2';
    }

    /**
     * Extrai apenas os dígitos de uma string
     */
    function extractDigits(value) {
        return String(value).replace(/\D/g, '');
    }

    /**
     * Formata o valor conforme o tipo (decimal ou inteiro)
     */
    function formatValue(digitsOnly) {
        if (!digitsOnly) return '';

        if (isInteger()) {
            return digitsOnly;
        }

        // Formato DECIMAL: 2 casas decimais
        const padded = digitsOnly.padStart(3, '0');
        const integerPart = padded.slice(0, -2);
        const decimalPart = padded.slice(-2);
        
        // Remove zeros à esquerda da parte inteira
        const cleanIntegerPart = integerPart.replace(/^0+/, '') || '0';
        
        return `${cleanIntegerPart}.${decimalPart}`;
    }

    /**
     * Atualiza os atributos do input conforme o tipo
     */
    function updateInputAttributes($input) {
        if (isInteger()) {
            $input.attr('type', 'number');
            $input.attr('step', '1');
            $input.attr('placeholder', '0');
        } else {
            $input.attr('type', 'number');
            $input.attr('step', '0.01');
            $input.attr('placeholder', '0.00');
        }
    }

    /**
     * Formata ambos os campos quando muda a unidade
     */
    function updateAllInputs() {
        updateInputAttributes($stockQuantity);
        updateInputAttributes($minQuantity);
        
        formatAndUpdateInput($stockQuantity);
        formatAndUpdateInput($minQuantity);
    }

    /**
     * Extrai dígitos do input e reaplica a formatação
     */
    function formatAndUpdateInput($input) {
        const currentValue = $input.val();
        const digits = extractDigits(currentValue);
        const formatted = formatValue(digits);
        
        $input.val(formatted);
    }

    /**
     * Configura eventos para um input de quantidade
     */
    function setupQuantityInput($input) {
        // Ao digitar, apenas permite números e formata em tempo real
        $input.on('input', function (e) {
            const $this = $(this);
            const currentValue = $this.val();
            
            // Extrair apenas dígitos
            const digits = extractDigits(currentValue);
            
            // Formatar e atualizar em tempo real
            const formatted = formatValue(digits);
            $this.val(formatted);
        });

        // Ao sair do campo, garante a formatação correta
        $input.on('blur', function () {
            formatAndUpdateInput($(this));
        });

        // Ao colar conteúdo
        $input.on('paste', function (e) {
            setTimeout(() => {
                formatAndUpdateInput($(this));
            }, 10);
        });
    }

    // Evento para mudar de unidade
    $unitSelect.on('change', function () {
        updateAllInputs();
    });

    // Configurar inputs de quantidade
    setupQuantityInput($stockQuantity);
    setupQuantityInput($minQuantity);

    // Aplicar formato inicial na carga
    updateAllInputs();
});
