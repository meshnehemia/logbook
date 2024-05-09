function deleteStudentRecord(Id) {
    fetch('../backend/delete.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `Id=${encodeURIComponent(Id)}`
    })
    .then(response => response.text())
    .then(data => {
        window.location.href = './deleteuser.php';
    })
    .catch(error => console.error('Error:', error));
}
