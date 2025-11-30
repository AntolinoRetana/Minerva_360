
        document.addEventListener('DOMContentLoaded', function () {
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.querySelector('.sidebar');
            
            // Crear el overlay dinámicamente
            const overlay = document.createElement('div');
            overlay.className = 'sidebar-overlay';
            document.body.appendChild(overlay);

            if (sidebarToggle && sidebar) {
                // 1. Al hacer clic en el botón hamburguesa
                sidebarToggle.addEventListener('click', function () {
                    sidebar.classList.toggle('show');
                });
            }

            // 2. Al hacer clic en el overlay (fondo oscuro)
            overlay.addEventListener('click', () => {
                sidebar.classList.remove('show');
            });

            // 3. Mostrar/ocultar overlay cuando el menú cambie
            const observer = new MutationObserver((mutations) => {
                mutations.forEach((mutation) => {
                    if (mutation.attributeName === 'class') {
                        overlay.classList.toggle('show', sidebar.classList.contains('show'));
                    }
                });
            });
            
            if (sidebar) {
                observer.observe(sidebar, { attributes: true });
            }
        });
