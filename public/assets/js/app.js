document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.sidebar-group-toggle').forEach(function(toggle) {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            var group = toggle.closest('.sidebar-group');
            group.classList.toggle('open');
            // Exibe ou oculta a setinha para baixo
            var chevron = toggle.querySelector('.bi-chevron-down');
            if (group.classList.contains('open')) {
                chevron.style.display = 'inline';
            } else {
                chevron.style.display = 'none';
            }
        });
        // Inicialmente oculta a setinha
        var chevron = toggle.querySelector('.bi-chevron-down');
        if (chevron) chevron.style.display = 'none';
    });

    // Sidebar label dynamic display
    var sidebar = document.querySelector('.sidebar');
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
    sidebar.addEventListener('mouseleave', updateLabels);
    updateLabels();
});