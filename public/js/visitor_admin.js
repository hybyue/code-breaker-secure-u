function searchTable() {
    var input, filter, table, tr, td, i, j, txtValue;
    input = document.getElementById("search");
    filter = input.value.toUpperCase();
    table = document.getElementById("visitorTable");
    tr = table.getElementsByTagName("tr");

    for (i = 1; i < tr.length; i++) {
        tr[i].style.display = "none";
        td = tr[i].getElementsByTagName("td");
        for (j = 0; j < td.length; j++) {
            if (td[j]) {
                txtValue = td[j].textContent || td[j].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                    break;
                }
            }
        }
    }
}

function searchVisitors() {
    let query = document.getElementById("search_visitor").value;
    if (query.length > 2) {
        fetch(`/admin/search_visitor?query=${query}`)
            .then((response) => response.json())
            .then((data) => {
                let suggestions = document.getElementById("visitorSuggestions");
                suggestions.innerHTML = "";
                data.forEach((visit) => {
                    let item = document.createElement("a");
                    item.href = "#";
                    item.classList.add(
                        "list-group-item",
                        "list-group-item-action"
                    );
                    item.innerText = `${visit.last_name}, ${visit.first_name} ${visit.middle_name}`;
                    item.onclick = () => fillVisitorForm(visit);
                    suggestions.appendChild(item);
                });
            });
    }
}

function fillVisitorForm(visit) {
    document.getElementById("last_name").value = visit.last_name;
    document.getElementById("first_name").value = visit.first_name;
    document.getElementById("middle_name").value = visit.middle_name;
    document.getElementById("person_to_visit").value = visit.person_to_visit;
    document.getElementById("purpose").value = visit.purpose;
    document.getElementById("visitorSuggestions").innerHTML = "";
}
