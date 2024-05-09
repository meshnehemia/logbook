
function deleteStudentRecord(studentId) {
    alert(studentId);
    fetch('../backend/delete.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `student_id=${encodeURIComponent(studentId)}`
    })
    window.location.href = './companyinfo.php';
}

