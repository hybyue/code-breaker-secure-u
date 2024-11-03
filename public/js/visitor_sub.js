
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





