window.addEventListener("load", function (event) {
    this.document.getElementById("loading").style.display = "none";
});

let token = document.head.querySelector('meta[name="csrf-token"]');
let mainUrl = document.head.querySelector('meta[name="main-url"]');
window.axios.defaults.headers.common["X-CSRF-TOKEN"] = token.content;

loadTransactions();
function loadTransactions() {
    if (document.getElementById("loading").style.display == "none") {
        document.getElementById("loading").style.display = "block";
    }

    axios.get(mainUrl.content + "/transaction").then((response) => {
        document.getElementById("loading").style.display = "none";
        transactions = response.data.transactions.data;

        let content = `<tr>`;
        counter = response.data.transactions.from;

        transactions.forEach((transaction, i) => {
            content += `
               <th scope="row">${counter}</th>
               <td>${transaction.code}</td>
               <td>${transaction.item.name}</td>
               <td>${transaction.quantity}</td>
               <td style="text-align: center"><a href="javascript:void(0)" class="btn btn-danger btn-sm">hapus</a> <a href="javascript:void(0)" class="btn btn-primary btn-sm">ubah</a></td>`;
            counter++;
        });

        content += `</tr>`;
        //    for (const key in transactions) {
        //        if (Object.hasOwnProperty.call(transactions, key)) {
        //            const transaction = transactions[key];
        //        }
        //    }

        document.getElementById("tbody").innerHTML = content;
    });
}

function addTransaction(e) {
    formControl = `<input type="number" style="width:30%" name="" id="qty" class="form-control">`;
    const elemenT = e.target;

    const tbody = document.getElementById("tbody");
    const itemSelections = $("#itemSelection").html();
    $(tbody).append(
        `
          <tr>
               <th scope="row"></th>
               <td></td>
               <td><select  class="custom-select">${itemSelections}</select></td>
               <td>${formControl}</td>
               <td style="text-align: center">
                    <a href="javascript:void(0)" onclick="removeRow(event)" class="btn btn-danger btn-sm">batal</a>
                    <a href="javascript:void(0)" onclick="saveRow(event)" class="btn btn-success btn-sm">simpan</a>
               </td>
          <tr/>
         `
    );
}

function removeRow(e) {
    const anchorEl = e.target;
    const tdEl = anchorEl.parentNode;
    const trEl = tdEl.parentNode;
    trEl.parentNode.removeChild(trEl);

    console.log(this.state);
}

function saveRow(e) {
    document.getElementById("loading").style.display = "block";
    tr = $(e.target).parents("tr");
    data = {
        item: tr.find("select").val(),
        qty: tr.find("#qty").val(),
    };

    axios.get(mainUrl + "/transaction/storeing", data).then((response) => {
        document.getElementById("loading").style.display == "none";
        console.log(response);
        loadTransactions();
    });
}
