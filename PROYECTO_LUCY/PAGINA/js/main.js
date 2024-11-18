// Función para confirmar antes de eliminar un elemento
function confirmDelete(message) {
    return confirm(message); // Devuelve true si el usuario confirma
}

// Función para validar un formulario de productos (por ejemplo)
function validateProductForm() {
    let productName = document.getElementById('productName').value;
    let productPrice = document.getElementById('productPrice').value;
    
    if (productName === "" || productPrice === "") {
        alert("Por favor, completa todos los campos.");
        return false; // Evita que el formulario se envíe
    }
    return true; // Permite el envío del formulario si todo está correcto
}

// Función para mostrar una alerta personalizada
function showAlert(message, type) {
    let alertBox = document.createElement('div');
    alertBox.className = 'alert ' + type;
    alertBox.innerHTML = message;
    document.body.appendChild(alertBox);
    setTimeout(() => {
        alertBox.remove(); // Remueve la alerta después de 3 segundos
    }, 3000);
}

// Añadir un evento al cargar el documento
document.addEventListener("DOMContentLoaded", function() {
    // Por ejemplo, agregar un evento a los botones de eliminar
    let deleteButtons = document.querySelectorAll('.delete-button');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            if (!confirmDelete("¿Estás seguro de que deseas eliminar este elemento?")) {
                e.preventDefault(); // Evita la acción de eliminar si no hay confirmación
            }
        });
    });
});