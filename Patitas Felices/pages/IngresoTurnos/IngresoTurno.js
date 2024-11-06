const calendarElement = document.getElementById('calendar');
const saveButton = document.getElementById('saveDates');
const today = new Date();
const currentMonth = today.getMonth();
const currentYear = today.getFullYear();

// Obtener el primer y último día del mes actual y el siguiente
const startDate = new Date(currentYear, currentMonth, 1);
const endDate = new Date(currentYear, currentMonth + 2, 0); // Último día del siguiente mes

// Crear el calendario
function createCalendar() {
    for (let day = startDate.getDate(); day <= endDate.getDate(); day++) {
        const date = new Date(currentYear, currentMonth, day);
        const dayDiv = document.createElement('div');
        dayDiv.classList.add('day');
        dayDiv.textContent = day;

        // Marcar días pasados
        if (date < today) {
            dayDiv.classList.add('past');
        }

        // Marcar domingos
        if (date.getDay() === 0) {
            dayDiv.classList.add('sunday');
        }

        // Agregar evento de clic
        dayDiv.addEventListener('click', () => {
            if (!dayDiv.classList.contains('past')) {
                dayDiv.classList.toggle('selected');
            }
        });

        calendarElement.appendChild(dayDiv);
    }
}

// Guardar las fechas seleccionadas
saveButton.addEventListener('click', () => {
    const selectedDays = Array.from(document.querySelectorAll('.day.selected'))
        .map(day => {
            return new Date(currentYear, currentMonth, day.textContent).toISOString();
        });

    // Aquí puedes hacer una llamada AJAX para guardar las fechas en la base de datos
    fetch('guardar_turnos.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ fechas: selectedDays })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Fechas guardadas con éxito.');
        } else {
            alert('Error al guardar las fechas.');
        }
    });
});

// Inicializar el calendario
createCalendar();
