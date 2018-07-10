# Add device


**URL** : `/api/device/token/push`

**Method** : `PUT`

**Auth required** : NO

**Data constraints**

```json
{
    "adid": "[required|string|max:190|exists:devices,adid]", 
    "token_push": "[required|string|max:190]",
    "version_app": "[string|max:190]"
}
```

**Data example**

```json
{
    "adid": "52e60ae5-75e5-4918-a690-cac145bbe127",
    "token_push": "5a606e441e2045a09a677ea5f18c73a6",
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
       "token_push": "5a606e441e2045a09a677ea5f18c73a6",
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
