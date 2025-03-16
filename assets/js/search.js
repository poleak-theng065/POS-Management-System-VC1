
// Search
function searchOrders() {
    const input = document.getElementById('searchOrderInput');
    const filter = input.value.toLowerCase();
    const table = document.getElementById('switchTableBody');
    const rows = table.getElementsByTagName('tr');

    for (let i = 0; i < rows.length; i++) {
        const cells = rows[i].getElementsByTagName('td');
        let rowVisible = false;

        for (let j = 0; j < cells.length - 1; j++) {
            if (cells[j].textContent.toLowerCase().includes(filter)) {
                rowVisible = true;
                break;
            }
        }

        rows[i].style.display = rowVisible ? '' : 'none';
    }
}