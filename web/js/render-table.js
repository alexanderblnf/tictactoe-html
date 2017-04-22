function render_table() {
    for(var i = 0; i < 5; i++) {
        var row = document.createElement('tr');
        for(var j = 0; j < 5; j++) {
            var td = document.createElement('td');
            var div = document.createElement('div');
            div.id = 'div' + (5 * i + j);
            div.className = "button-div";
            var button = document.createElement('button');
            button.id = 'square' + (5 * i + j);
            button.className = "game-square btn";
            div.appendChild(button);
            td.appendChild(div);
            row.appendChild(td);
        }
        document.getElementById('game-table').appendChild(row);
    }
}