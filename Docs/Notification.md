# Notification Feature
The endpoint controls Notification resource.-


### GET

## Retrieve a list of Notifications [/v1/notifications/:user_id]

 Retrieve a list of Notifications for specific user.

### GET

+ Parameter
    + id: `2` (required, integer) - To filter by specific user id.


+ Response 200 (application/json; charset=utf-8)

    + Body

          {
              "success": 1,
              "code": 201,
              "meta": {
                "method": "GET",
                "endpoint": "api/v1/notifications/2",
                "limit": 30,
                "offset": 0
              },
              "data": [
                  {
                      "title": "dicta",
                      "type": "Offer",
                      "descriptions": "Hic et eum quis optio.",
                      "date": "2017-05-20"
                  },
                  {
                      "title": "voluptate",
                      "type": "Comfirmation",
                      "descriptions": "Quis quis dolores tenetur omnis porro repellat.",
                      "date": "1985-04-14"
                  }
              ],
              "errors": {},
              "duration": 0.036
              }

+ Response 404 (application/json; charset=utf-8)

    + Body

          {
              "success": 0,
              "code": 404,
              "meta": {
                "method": "GET",
                "endpoint": "api/v1/notification/55",
                "limit": 30,
                "offset": 0
              },
              "data": [],
              "errors": {
                "message": "The resource that match ID: ( 55 ) does not found.",
                "code": 400001
              },
              "duration": 0.088
          }


## Creates a Notification [/v1/notifications]

  Creates a notification.

### POST
+ Parameters
    + user_id: `1` (required, string).
    + type: `info` or `offer` or `comfirm`(required, string).
    + title: `some title` (required, string).
    + descriptions: `some descriptions` (required, string).
    + date: `2015-12-22` (required, date).


+ Response 201 (application/json; charset=utf-8)

    + Body

          {
              "success": 1,
              "code": 201,
              "meta": {
                  "method": "POST",
                  "endpoint": "api/v1/notifications",
                  "limit": 30,
                  "offset": 0
              },
              "data": {
                  "id": 22
              },
              "errors": {},
              "duration": 0.044
          }

+ Response 400 (application/json; charset=utf-8)

    + Body

          {
              "success": 0,
              "code": 400,
              "meta": {
                  "method": "POST",
                  "endpoint": "api/v1/notifications",
                  "limit": 30,
                  "offset": 0
              },
              "data": [],
              "errors": {
                  "message": "The request parameters are incorrect, please make sure to follow the documentation.",
                  "code": 400002,
                  "validation": [
                        {
                            "attribue": "type",
                            "message": "The type field is required."
                        },
                        {
                            "attribue": "title",
                            "message": "The title field is required."
                        },
                        {
                            "attribue": "descriptions",
                            "message": "The descriptions field is required."
                        },
                        {
                            "attribue": "date",
                            "message": "The date field is required."
                        },
                        {
                            "attribue": "user_id",
                            "message": "The user id field is required."
                        },
                        {
                            "attribue": "user_id",
                            "message": "The selected user id is invalid."
                        },
                        {
                            "attribue": "date",
                            "message": "The date is not a valid date."
                        }
                  ]
              },
              "duration": 0.014
          }


## Deletes a Notification [/v1/notifications/:id]

  Deletes a notification that correspond to the ID as the last segment of the URL.

### DELETE

+ Parameter
    + id: `7` (required, integer) - A primary key of notification id.


+ Response 200 (application/json; charset=utf-8)

    + Body

          {
              "success": 1,
              "code": 200,
              "meta": {
                  "method": "DELETE",
                  "endpoint": "api/v1/notifications/7",
                  "limit": 30,
                  "offset": 0
              },
              "data": {
                  "deleted": 1
              },
              "errors": {},
              "duration": 0.066
          }

+ Response 404 (application/json; charset=utf-8)

    + Body

          {
              "success": 0,
              "code": 404,
              "meta": {
                  "method": "DELETE",
                  "endpoint": "api/v1/notifications/22",
                  "limit": 30,
                  "offset": 0
              },
              "data": [],
              "errors": {
                  "message": "The resource that match ID: ( 22 ) does not found.",
                  "code": 400004
              },
              "duration": 0.037
          }
