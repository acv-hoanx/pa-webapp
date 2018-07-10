# Add device


**URL** : `/api/device/add`

**Method** : `POST`

**Auth required** : NO

**Data constraints**

```json
{
    "device_name": "[string|max:190]",
    "uuid": "[string|max:190]",
    "adid_old": "[string|max:190]", //if update
    "adid_new": "[required|string|max:190]", //add or update
    "os": "[string|max:190]",  // value 'ios' or 'android'
    "version_app": "[string|max:190]"
}
```

**Data example : Insert**

```json
{
    "device_name": "IP XXX",
    "uuid": "7f5d8efe-8323-11e8-adc0-fa7ae01bbebc",
    "adid_new": "5a606e44-1e20-45a0-9a67-7ea5f18c73a6",
    "os": "ios",
    "version_app": "1.0"
}
```

**Data example : Update**

```json
{
    "device_name": "IP XXX",
    "uuid": "7f5d8efe-8323-11e8-adc0-fa7ae01bbebc",
    "adid_old": "5a606e44-1e20-45a0-9a67-7ea5f18c73a6",
    "adid_new": "52e60ae5-75e5-4918-a690-cac145bbe127",
    "os": "ios", 
    "version_app": "1.0"
}
```

## Success Response

**Code** : `200 OK`

**Content example**

```json
{
   "data": {
       "id": 3,
       "device_name": "IP XXX",
       "uuid": "7f5d8efe-8323-11e8-adc0-fa7ae01bbebc",
       "adid": "52e60ae5-75e5-4918-a690-cac145bbe127",
       "os": "ios",
       "token_push": null,
       "version_app": "1.0",
       "created_at": "2018-07-09 02:20:29",
       "updated_at": "2018-07-09 02:30:48",
       "deleted_at": null
   }
}
```

## Error Response

**Code** : `422 Unprocessable Entity`

**Content** :

```json
{
    "message": "The given data was invalid.",
    "errors": {
        "adid_new": [
            "The adid new field is required."
        ]
    }
}
```
