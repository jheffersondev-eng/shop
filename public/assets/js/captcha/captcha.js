document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('contactForm');
    const submitBtn = document.getElementById('submitBtn');
    const captchaStatus = document.getElementById('captcha-status');
    const captchaError = document.getElementById('captcha-error');
    let lastToken = null;
    if (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            submitBtn.disabled = true;
            captchaError.style.display = 'none';
            captchaStatus.textContent = 'Validando segurança...';
            grecaptcha.ready(function () {
                grecaptcha.execute(window.RECAPTCHA_SITE_KEY, { action: 'contact' }).then(function (token) {
                    document.getElementById('g-recaptcha-response').value = token;
                    lastToken = token;
                    captchaStatus.textContent = 'Verificação concluída.';
                    form.submit();
                }).catch(function () {
                    captchaError.textContent = 'Erro ao marcar o captcha. Tente novamente.';
                    captchaError.style.display = 'block';
                    captchaStatus.textContent = '';
                    submitBtn.disabled = false;
                });
            });
        });
    }
});