# User Feature
The endpoint controls user resource.-


# Retrieve the list of user [/v1/users]

### GET

+ Parameters
    + limit : `30` (optional, integer)
    + offset : `0` (optional, integer)
    + type : `student` (optional, string) - To filter by user type.
    + name: `John` (optional, string) - To filter by name.
    + gender: `male` (optional, string) - To filter by user gender.
    + course: `PHP` (optional, string) - To filter by course name.
    + batch: `1` (optional, string) - To filter by batch name.


Retrieve the list of users.

+ Response 200 (application/json; charset=utf-8)

    + Body

            {
                "success": 1,
                "code": 200,
                "meta": {
                    "method": "GET",
                    "endpoint": "api/v1/users",
                    "limit": 30,
                    "offset": 0,
                    "total": 11
                },
                "data": [
                    {
                        "id": 16,
                        "name": "Dr. Amparo Parisian DVM",
                        "email": "abshire.caitlyn@example.com",
                        "gender": "male",
                        "date_of_birth": "1992-05-09",
                        "nrc_no": "XnishCyfXh",
                        "phone_no": "+5851914661556",
                        "address": "48740 Block Ridge Suite 645\nSouth Davionmouth, DC 44637",
                        "image": "http://localhost:8000/api/v1/users/image/16",
                        "type": "normal",
                        "course": {
                            "id": 4,
                            "name": "Jalen Farrell"
                        },
                        "batch": {
                            "id": 20,
                            "name": "Yoshiko Dicki V"
                        }
                    },
                    {
                        "id": 17,
                        "name": "Cydney Reichert V",
                        "email": "roslyn.gaylord@example.net",
                        "gender": "female",
                        "date_of_birth": "2004-08-30",
                        "nrc_no": "MJbx69sKT1",
                        "phone_no": "+7067628920204",
                        "address": "32070 Manley Road\nElwinview, MS 89305-6790",
                        "image": "http://localhost:8000/api/v1/users/image/17",
                        "type": "scanner",
                        "course": {
                            "id": 5,
                            "name": "Llewellyn Casper"
                        },
                        "batch": {
                            "id": 11,
                            "name": "Eino Muller"
                        }
                    },
                ],
                "errors": {},
                "duration": 1.006
            }


### GET

## Retrieve a specific User [/v1/users/:id]

 Retrieve a specific user.

### GET

+ Parameter
    + id: `1` (required, integer) - To filter by specific user id.


+ Response 200 (application/json; charset=utf-8)

    + Body

          {
              "success": 1,
              "code": 201,
              "meta": {
              "method": "GET",
              "endpoint": "api/v1/users/1",
              "limit": 30,
              "offset": 0
              },
              "data": [
                  {
                      "id": 1,
                      "name": "Prof. Oswald Ryan DVM",
                      "email": "llangworth@example.org",
                      "gender": "female",
                      "date_of_birth": "1984-03-10",
                      "nrc_no": "Xjz3CsaO1r",
                      "phone_no": "+6601968990335",
                      "address": "3970 Kenya Extension Suite 998\nNorth Jarredview, WI 94710-2329",
                      "image": "http://localhost:8000/api/v1/users/image/1",
                      "type": "teacher",
                      "course": {
                          "id": 7,
                          "name": "Prof. Bernie Wehner DVM"
                      },
                      "batch": {
                          "id": 20,
                          "name": "Yoshiko Dicki V"
                      }
                  }
              ],
              "errors": {},
              "duration": 0.081
        }

+ Response 404 (application/json; charset=utf-8)

    + Body

          {
              "success": 0,
              "code": 404,
              "meta": {
                "method": "GET",
                "endpoint": "api/v1/users/55",
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




##  Login Or Creates a User [/v1/users]

  Login into the system. If email is new it will register instead.

### POST
+ Parameters
    + name: `Min Thu Khant` (required, string).
    + image: `image.png` (required, image url).
    + email: `example@mail.com` (required, unique, string).
    + auth_token: `firebase token` (required, string).
    + gender: `male` (optional, string).
    + date_of_birth: `2015-12-22` (optional, date).
    + phone_no: `+092345456` (optional, string).
    + nrc_no: `1/MaMaNa(Ng)098765` (optional, string).
    + address: `No.1, Mingalardon, Yangon` (optional, string)
    + course_id: `1` (optional, integer).
    + batch_id: `1` (optional, integer).


+ Response 201 (application/json; charset=utf-8)

    + Body

            {
                "success": 1,
                "code": 201,
                "meta": {
                    "method": "POST",
                    "endpoint": "api/v1/users",
                    "limit": 30,
                    "offset": 0
                },
                "data": {
                      "user": {
                          "id": 21,
                          "name": "sdfs",
                          "email": "asfasfd@gmail.com",
                          "gender": "male",
                          "date_of_birth": null,
                          "nrc_no": null,
                          "phone_no": null,
                          "address": null,
                          "image": "adsfdasf",
                          "type": "normal",
                          "course": {
                              "id": "",
                              "name": ""
                          },
                          "batch": {
                              "id": "",
                              "name": ""
                          }
                      },
                      "auth_token": "hjhjh"
                  },
                "errors": {},
                "duration": 0.274
            }

+ Response 400 (application/json; charset=utf-8)

    + Body

          {
              "success": 0,
              "code": 400,
              "meta": {
                  "method": "POST",
                  "endpoint": "api/v1/users",
                  "limit": 30,
                  "offset": 0
              },
              "data": [],
              "errors": {
                  "message": "The request parameters are incorrect, please make sure to follow the documentation.",
                  "code": 400002,
                  "validation": [
                      {
                          "attribue": "name",
                          "message": "The name field is required."
                      },
                      {
                          "attribue": "email",
                          "message": "The email field is required."
                      },
                      {
                          "attribue": "email",
                          "message": "The email must be a valid email address."
                      },
                      {
                          "attribue": "image",
                          "message": "The image field is required."
                      },
                      {
                          "attribue": "auth_token",
                          "message": "The auth_token field is required."
                      }
                  ]
              },
              "duration": 0.047
          }

## Updates a User [/v1/users/:id]

  Updates a user that correspond to the ID as the last segment of the URL.

  ### PUT

  + Parameters
      + id: `1` (required, string). - To filter by specific user id.
      + name: `Min Thu Khant` (optional, string).
      + email: `example@mail.com` (optional, unique, email, string).
      + auth_token: `firebase token` (optional, string).
      + gender: `male` (optional, string).
      + date_of_birth: `2015-12-22` (optional, date).
      + phone_no: `+092345456` (optional, string).
      + nrc_no: `1/MaMaNa(Ng)098765` (optional, string).
      + address: `No.1, Mingalardon, Yangon` (optional, string)
      + user_type: `student` (optional, string).
      + course_id: `1` (optional, integer).
      + batch_id: `1` (optional, integer).
      + image: `image` (optional, image url).



+ Response 201 (application/json; charset=utf-8)

    + Body

          {
              "success": 1,
              "code": 200,
              "meta": {
                  "method": "PUT",
                  "endpoint": "api/v1/users/11",
                  "limit": 30,
                  "offset": 0
              },
              "data": {
                  "updated": 1
              },
              "errors": {},
              "duration": 0.056
          }

+ Response 400 (application/json; charset=utf-8)

    + Body

          {
              "success": 0,
              "code": 400,
              "meta": {
              "method": "PUT",
              "endpoint": "api/v1/users/1",
              "limit": 30,
              "offset": 0
              },
              "data": [],
              "errors": {
              "message": "The request parameters are incorrect, please make sure to follow the documentation.",
              "code": 400002,
              "validation": [
                  {
                      "attribue": "email",
                      "message": "The email must be a valid email address."
                  },
                  {
                      "attribue": "date_of_birth",
                      "message": "The date of birth is not a valid date."
                  }
              ]
              },
              "duration": 0.102
          }


## Deletes a User [/v1/users/:id]

  Deletes a user that correspond to the ID as the last segment of the URL.

### DELETE

+ Parameter
    + user_id: `7` (required, integer) - A primary key of user id.


+ Response 200 (application/json; charset=utf-8)

    + Body

          {
              "success": 1,
              "code": 200,
              "meta": {
                  "method": "DELETE",
                  "endpoint": "api/v1/users/1",
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
                  "endpoint": "api/v1/users/1777",
                  "limit": 30,
                  "offset": 0
              },
              "data": [],
              "errors": {
                  "message": "The resource that match ID: ( 1777 ) does not found.",
                  "code": 400001
              },
              "duration": 0.058
          }
