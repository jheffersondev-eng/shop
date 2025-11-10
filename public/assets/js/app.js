document.addEventListener('DOMContentLoaded', function() {
    var sidebar = document.querySelector('.sidebar');
    document.querySelectorAll('.sidebar-group-toggle').forEach(function(toggle) {
        toggle.addEventListener('click', function(e) {
            // Permitir expandir ao clicar no ícone, nome ou seta
            if (
                e.target.classList.contains('sidebar-group-toggle') ||
                e.target.classList.contains('sidebar-label') ||
                e.target.classList.contains('sidebar-chevron') ||
                e.target.classList.contains('bi-chevron-down') ||
                e.target.classList.contains('sidebar-icon')
            ) {
                e.preventDefault();
                var group = toggle.closest('.sidebar-group');
                var submenu = group.querySelector('.sidebar-submenu');
                if (group.classList.contains('open')) {
                    group.classList.remove('open');
                } else {
                    closeAllGroups();
                    group.classList.add('open');
                }
            }
        });
    });

    // Sidebar label dynamic display
    var labels = document.querySelectorAll('.sidebar-label');
    function updateLabels() {
        if (sidebar.matches(':hover')) {
            labels.forEach(function(label) {
                label.style.display = 'inline';
            });
        } else {
            labels.forEach(function(label) {
                label.style.display = 'none';
            });
        }
    }
    sidebar.addEventListener('mouseenter', updateLabels);
    sidebar.addEventListener('mouseleave', function() { updateLabels(); closeAllGroups(); });
    updateLabels();

    // Fecha submenus ao clicar fora do sidebar ou ao pressionar ESC
    function closeAllGroups() {
        document.querySelectorAll('.sidebar-group.open').forEach(function(g) {
            g.classList.remove('open');
        });
    }

    document.addEventListener('click', function(e) {
        var insideSidebar = !!e.target.closest('.sidebar');
        if (!insideSidebar) {
            closeAllGroups();
        }
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' || e.key === 'Esc') {
            closeAllGroups();
        }
    });
});