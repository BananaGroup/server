Server
======

This script allows you to create and read readings from the sensors.

## Posting Data

There are three ways to post days

### CSV
A csv file is posted using the text post variable named `datatype` and value `csv`, with the file supplied and named `file`
CSV file must have headers named as **user_id**, **sensor_id**, **value**, **json**, followed by the required data.

### JSON
Similarly to how a csv file is posted, a text post variable `datatype` = `json` and the file under `file`.

### POST
A singular reading can be posted using `user_id`, `sensor_id`, `value`, and `timestamp`.


## Reading Data

When reading data, a user_id has to be specified, then a number of other url encoded queries can be supplied to alter the data
- `timestamp` get all readings with a specific timestamp
- `before` get all readings with a timestamp before said variable
- `after` get all readings with a timestamp after said variable
- `before` and `after` get all readings in range

All data receieved is JSON encoded