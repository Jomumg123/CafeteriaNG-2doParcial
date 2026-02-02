/**
 * =======================================================
 * JS para Coffee NG 
 * =======================================================
 */

document.addEventListener('DOMContentLoaded', () => {
    console.log("Coffee NG: El sitio ha cargado completamente.");

    // --- Inicialización de Event Listeners ---
    
    if (document.querySelector('.menu-catalogo')) {
        highlightMenuItems();
    }

    const contactForm = document.querySelector('.contact-form');
    if (contactForm) {
        // Llama a la nueva función para manejar la lógica de sugerencias
        setupFeedbackLogic(); 
        setupContactForm(contactForm);
    }
    
    setupScrollNavigation(); 
});


// =======================================================
// 2. FUNCIÓN NUEVA: Lógica para mostrar/ocultar el campo de Sugerencias
// =======================================================

function setupFeedbackLogic() {
    const calificacionSelect = document.querySelector('#calificacion');
    const sugerenciasContainer = document.querySelector('#sugerencias-container');
    const sugerenciasTextarea = document.querySelector('#sugerencias');

    if (!calificacionSelect || !sugerenciasContainer) return; // Salir si no se encuentran elementos

    const toggleSugerencias = () => {
        // Los valores son strings. Si el valor es 3, 2, o 1, mostrar el campo.
        const valor = parseInt(calificacionSelect.value);
        
        if (valor <= 3 && valor >= 1) {
            sugerenciasContainer.style.display = 'block';
            sugerenciasTextarea.setAttribute('required', 'required'); // Hacer el campo requerido
        } else {
            sugerenciasContainer.style.display = 'none';
            sugerenciasTextarea.removeAttribute('required');
            sugerenciasTextarea.value = ''; // Limpiar el campo si se oculta
        }
    };

    // Asignar el listener para que la función se ejecute cuando cambie la selección
    calificacionSelect.addEventListener('change', toggleSugerencias);

    // Ejecutar al cargar para manejar el estado inicial (aunque por defecto es "Selecciona una Opción")
    toggleSugerencias(); 
}

// =======================================================
// 3. FUNCIONALIDAD DEL FORMULARIO DE CONTACTO (contacto.html)
// =======================================================

function setupContactForm(form) {
    form.addEventListener('submit', (event) => {
        event.preventDefault(); 
        
        // Identificamos qué botón se presionó
        const submitButtonText = event.submitter.textContent;
        const isPedidoConsulta = submitButtonText.includes('Pedido') || submitButtonText.includes('Consulta');
        const isFeedback = submitButtonText.includes('Calificación');
        
        // --- 1. Validar PEDIDO/CONSULTA ---
        if (isPedidoConsulta) {
            const nombre = form.querySelector('#nombre').value.trim();
            const email = form.querySelector('#email').value.trim();
            const mensaje = form.querySelector('#mensaje').value.trim();
            // Celular es opcional (no requerido aquí)

            if (!nombre || !email || !mensaje) {
                alert('Para enviar un Pedido/Consulta, por favor, completa tu Nombre, Correo Electrónico y el Mensaje/Pedido.');
                return;
            }
            alert('✅ ¡Pedido/Consulta enviado! Nos pondremos en contacto contigo pronto. Gracias por elegir Coffee NG.');

        // --- 2. Validar FEEDBACK ---
        } else if (isFeedback) {
            const calificacion = form.querySelector('#calificacion').value;
            const sugerencias = form.querySelector('#sugerencias');
            
            if (!calificacion) {
                alert('Por favor, selecciona una opcion para enviar tu Calificación.');
                return;
            }

            // Validar campo de sugerencias si es visible (3 estrellas o menos)
            if (sugerencias.hasAttribute('required') && sugerencias.value.trim() === '') {
                 alert('Por favor, ingresa tus sugerencias o motivos para esta calificación.');
                 return;
            }

            alert('⭐ ¡Gracias por tu calificación y/o sugerencia! Tu opinión es muy valiosa para Coffee NG.');
        }

        form.reset(); 
    });
}




function highlightMenuItems() {
    const menuItems = document.querySelectorAll('.menu-item');
    menuItems.forEach(item => {
        item.addEventListener('mouseenter', () => {
            item.classList.add('is-highlighted');
        });
        item.addEventListener('mouseleave', () => {
            item.classList.remove('is-highlighted');
        });
    });
}

function setupScrollNavigation() {
    const header = document.querySelector('.main-header');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            header.classList.add('header-scrolled');
        } else {
            header.classList.remove('header-scrolled');
        }
    });
}