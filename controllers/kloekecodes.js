// ===========================================================
// CONTROLLER: Kloekecodes.
// ===========================================================

/**
 * @api      {get} /kloekecode/all Get all the kloekecodes.
 *
 * @apiName  GetKloekecodes
 * @apiGroup Kloekecode
 */
exports.all = function(req, res) {
    var query = "SELECT * FROM ??";
    var table = ["kloekecode"];

    connection.query(mysql.format(query,table), function(err, rows, fields) {
        if   (!err) res.json(rows);
        else console.log('Error while performing Query.');
    });
}
