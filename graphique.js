function chomage() {
    const estCoche = $("input[value='chomage']").prop("checked");
    if (estCoche) {
        $("#chom").slideDown();
    } else {
        $("#chom").slideUp();
        $("#chom input[type='checkbox']").prop("checked", false);
        afficherGraphique();
    }
}

function footer() {
    if ($("#vide").html() == ""){
        $("#footer").css("margin-top","60px");
    }
    else{
        $("#footer").css("margin-top","380px");
    }
}

function ajusterCouleur(couleur, facteur) {
    let r = parseInt(couleur.substring(1, 3), 16);
    let g = parseInt(couleur.substring(3, 5), 16);
    let b = parseInt(couleur.substring(5, 7), 16);
    r = Math.min(255, Math.max(0, r + (255 - r) * facteur));
    g = Math.min(255, Math.max(0, g + (255 - g) * facteur));
    b = Math.min(255, Math.max(0, b + (255 - b) * facteur));
    return `#${Math.round(r).toString(16).padStart(2, '0')}${Math.round(g).toString(16).padStart(2, '0')}${Math.round(b).toString(16).padStart(2, '0')}`;
}

var chart;

async function chargerDonnees(pays, indicateur) {
    const anneeMin = document.getElementById("anneeMin").value;
    const anneeMax = document.getElementById("anneeMax").value;
    const resp = await fetch('requete.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'pays=' + pays + '&indicateur=' + indicateur + '&anneeMin=' + anneeMin + '&anneeMax=' + anneeMax
    });
    const data = await resp.json();
    return {pays, indicateur, data};
}

async function afficherGraphique() {
    const ctx = document.getElementById('graph').getContext('2d');
    const paysChoisi = Array.from(document.querySelectorAll('input[name="pays"]:checked')).map(cb => cb.value);
    const indChoisi = Array.from(document.querySelectorAll('input[name="ind"]:checked')).map(cb => cb.value);
    $("#vide").html("");
    if (paysChoisi.length === 0 || indChoisi.length === 0) {
        if (chart){
            chart.destroy();
        }
        let mes;
        if (paysChoisi.length === 0){
            mes = "Veuillez sélectionner au moins un pays.";
        }
        if (indChoisi.length === 0){
            mes = "Veuillez sélectionner au moins un indicateur.";
        }
        if (paysChoisi.length === 0 && indChoisi.length === 0){
            mes = "Veuillez sélectionner au moins un pays et un indicateur.";
        }
        $("#vide").html(mes);
        footer();
        return;
    }
    const couleurs = [
        '#1f77b4', '#ff7f0e', '#2ca02c', '#d62728', '#9467bd',
        '#8c564b', '#e377c2', '#7f7f7f', '#bcbd22', '#17becf',
        '#393b79', '#637939', '#8c6d31', '#843c39', '#7b4173',
        '#5254a3', '#9c9ede', '#6b6ecf', '#e6550d', '#fd8d3c',
        '#31a354', '#74c476', '#9e9ac8', '#a1d99b', '#ff9896',
        '#c7c7c7', '#98df8a'
    ];
    const datasets = [];
    const scales = {};
    const variationIndicateur = {
        inflation: 0,
        dette: 0.5,
        chomage_pourcent: -0.45,
        chomage_nombre: -0.75
    };
    for (let j = 0; j < indChoisi.length; j++) {
        const ind = indChoisi[j];
        const axeId = `y${j === 0 ? '' : j}`;
        scales[axeId] = {
            type: 'linear',
            position: j % 2 === 0 ? 'left' : 'right',
            title: {display: true, text: ind},
            grid: {drawOnChartArea: j === 0}
        };
        for(let i = 0; i < paysChoisi.length; i++) {
            const pays = paysChoisi[i];
            const { data } = await chargerDonnees(pays, ind);
            const points = data.map(row => ({
                x: new Date(row.date),
                y: parseFloat(row.valeur)
            }));
            const baseCouleur = couleurs[i % couleurs.length];
            const facteur = variationIndicateur[ind] ?? 0;
            const couleurModifiee = ajusterCouleur(baseCouleur, facteur);
            datasets.push({
                label: pays + ' – ' + ind,
                data: points,
                borderColor: couleurModifiee,
                backgroundColor: couleurModifiee + '33',
                fill: false,
                tension: 0.3,
                yAxisID: axeId
            });
        }
    }
    if (datasets.every(ds => ds.data.length === 0)) {
        if (chart) chart.destroy();
        document.getElementById("vide").innerText = "Aucune donnée disponible pour la période sélectionnée.";
        footer();
        return;
    }

    if (chart) chart.destroy();
    chart = new Chart(ctx, {
        type: 'line',
        data: {
            datasets: datasets
        },
        options: {
            responsive: true,
            interaction: {mode: 'index', intersect: false},
            stacked: false,
            plugins: {
                legend: { position: 'bottom' },
                title: { display: true, text: 'Indicateurs : ' + indChoisi.join(', ') + ' | Pays : ' + paysChoisi.join(', ') }
            },
            scales: {
                x: {
                    type: 'time',
                    time: {
                        unit: 'year',
                        displayFormats: { year: 'yyyy' }
                    },
                    title: { display: true, text: 'Année' }
                },
                ...scales
            }
        }
    });
    footer();
}
$(document).ready(function(){
    afficherGraphique();
});