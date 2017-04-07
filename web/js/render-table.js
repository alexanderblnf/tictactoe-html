function render_table() {
    for(var i = 0; i < 5; i++) {
        var row = document.createElement('tr');
        for(var j = 0; j < 5; j++) {
            var td = document.createElement('td');
            var button = document.createElement('button');
            button.id = 'square' + (5 * i + j);
            button.className = "game-square btn";
            td.appendChild(button);
            row.appendChild(td);
        }
        document.getElementById('game-table').appendChild(row);
    }
}