# Mollo Client

## Bundles and Fields:


### Bundle Client
#### General
- speciality (term)
- voice_position (term)
- function (term)
- position (term)
- instrument (term)
- is_active (bool)
- entry (date)
- resigning (date)
- historical (bool) depricated

#### Personal
 - images
 - first_name
 - last_name
 - birthday
 - link
 - wikipedia
 - facebook


#### Contact
 - email
 - mobile
 - phone

#### Address
 - gender (term)
 - street_and_number
 - city
 - zip_code
 - country (term)

#### Helper
 - user
 - token

### Bundle roles
 - name
 - artist (ref)
 - event_solo (ref)
 - description

### Bundle Client Group
 - name
 - artists (ref)
 - description

### Vocabularies
 - voice_position
 - instrument
 - function
 - position
 - speciality
