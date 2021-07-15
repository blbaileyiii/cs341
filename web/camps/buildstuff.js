app.post("/addJournalEntry", addJournalEntry);

function addJournalEntry(req, res) {
    console.log("Posting data");
    // var id = req.query.id;
    //body is for post, query is for get
    const customer_id = req.session.user;
    const journal_entry_date = req.body.journal_entry_date;
    const journal_entry = req.body.journal_entry;
    const params = [journal_entry, journal_entry_date, customer_id];
    addEntryFromDataLayer(params, function (error, addEntry) {
        console.log("Back From the addEntryFromDataLayer:", addEntry);
        if (error || addEntry == null) {
            res.status(500).json({
                success: false,
                data: error
            });
        }
        else {
            // res.json(result);
            res.status(200).json(addEntry);
        }
    });
}
function addEntryFromDataLayer(customer_id, params, callback) {
    console.log("addEntryFromDataLayer called with id");
    console.log("this is customer id inside the data layer",customer_id, "this is after the customer id");
    var sql = "INSERT INTO journal (journal_entry, journal_entry_date, customer_id) VALUES($1::text, $2::text, '"+customer_id+"')";
    // var params = [id];
    pool.query(sql, customer_id, params, function (err, addEntry) {
        if (err) {
            console.log("error in database connection");
            console.log(err);
            callback(err, null);
        }
        console.log("Found DB result:" + JSON.stringify(addEntry));
        callback(null, addEntry);
    });
}


app.use(express.urlencoded({ extended: true }));
app.use(express.json());

app.post('/', async (req, res) => {
    try {

        const customer_id = req.session.user;
        const journal_entry_date = req.body.journal_entry_date;
        const journal_entry = req.body.journal_entry;

        var sql = "INSERT INTO journal (journal_entry, journal_entry_date, customer_id) VALUES('"+journal_entry+"', '"+journal_entry_date+"', '"+customer_id+"')";

        const client = await pool.connect();
        const result = await client.query(sql);
        //UPDATE char SET locationid='+locid+' WHERE charid='+charid+';
        const results = { 'results': (result) ? result.rows : null};
        res.end(JSON.stringify(results));
        client.release();
    } catch (err) {
        console.error(err);
        res.send("Error " + err);
    }
});

