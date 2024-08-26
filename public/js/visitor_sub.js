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

function searchVisitor() {
    let query = document.getElementById("search_visitor").value;
    if (query.length > 2) {
        fetch(`/sub-admin/search_visitor?query=${query}`)
            .then((response) => response.json())
            .then((data) => {
                let suggestions = document.getElementById("visitorSuggestions");
                suggestions.innerHTML = "";
                data.forEach((visitor) => {
                    let item = document.createElement("a");
                    item.href = "#";
                    item.classList.add(
                        "list-group-item",
                        "list-group-item-action"
                    );
                    item.innerText = `${visitor.last_name}, ${visitor.first_name} ${visitor.middle_name}`;
                    item.onclick = () => fillVisitorForm(visitor);
                    suggestions.appendChild(item);
                });
            });
    }
}

function fillVisitorForm(visitor) {
    document.getElementById("last_name").value = visitor.last_name;
    document.getElementById("first_name").value = visitor.first_name;
    document.getElementById("middle_name").value = visitor.middle_name;
    document.getElementById("person_to_visit").value = visitor.person_to_visit;
    document.getElementById("purpose").value = visitor.purpose;
    document.getElementById("visitorSuggestions").innerHTML = "";
}
