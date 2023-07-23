let abc = document.querySelector('#abc');
let sidebar = document.querySelector('.sidebar');
let listItem = document.querySelectorAll('.list-item');

abc.onclick = function() {
    sidebar.classList.toggle('active');

}

function activeLink() {
    listItem.forEach(item =>
        item.classList.remove('active'));
    this.classList.add('active');
}
listItem.forEach(item =>
    item.onclick = activeLink);
    
    document.addEventListener("DOMContentLoaded", function() {
        // Sprawdź, czy powiadomienie zostało wyświetlone
        const notificationDisplayed = sessionStorage.getItem("eventAddedNotification");
        if (!notificationDisplayed) {
            // Jeśli powiadomienie nie zostało wyświetlone, wyświetl je i zapisz informację w sesji
            const alertDiv = document.querySelector(".alert");
            if (alertDiv) {
                alertDiv.style.display = "block";
                sessionStorage.setItem("eventAddedNotification", "true");
            }
        } else {
            // Jeśli powiadomienie zostało już wyświetlone, ukryj je
            const alertDiv = document.querySelector(".alert");
            if (alertDiv) {
                alertDiv.style.display = "none";
            }
        }
    });
