<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Confirmar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body" id="confirmModalBody">
                Confirma a ação?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Não</button>
                <button type="button" class="btn btn-danger btn-sm" id="confirmModalConfirm">Sim</button>
            </div>
        </div>
    </div>
</div>

<script>
    (function(){
        var confirmModalEl = document.getElementById('confirmModal');
        if(!confirmModalEl) return;
        var bsModal = new bootstrap.Modal(confirmModalEl);
        var actionToSubmit = null;
        var methodToUse = 'POST';

        document.addEventListener('click', function(e){
            var trigger = e.target.closest('.btn-confirm');
            if(!trigger) return;
            e.preventDefault();
            var title = trigger.getAttribute('data-title') || 'Confirmar';
            var message = trigger.getAttribute('data-message') || 'Deseja confirmar?';
            actionToSubmit = trigger.getAttribute('data-action');
            methodToUse = trigger.getAttribute('data-method') || 'POST';
            document.getElementById('confirmModalLabel').textContent = title;
            document.getElementById('confirmModalBody').textContent = message;
            bsModal.show();
        });

        document.getElementById('confirmModalConfirm').addEventListener('click', function(){
            if(!actionToSubmit) { bsModal.hide(); return; }
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = actionToSubmit;
            form.style.display = 'none';
            var token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            if(token){
                var input = document.createElement('input');
                input.type = 'hidden';
                input.name = '_token';
                input.value = token;
                form.appendChild(input);
            }
            if(methodToUse && methodToUse.toUpperCase() !== 'POST'){
                var m = document.createElement('input');
                m.type = 'hidden';
                m.name = '_method';
                m.value = methodToUse.toUpperCase();
                form.appendChild(m);
            }
            document.body.appendChild(form);
            form.submit();
        });
    })();
</script>
