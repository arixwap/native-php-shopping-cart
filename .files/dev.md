# PROGRESS
- Router Class
- Move View, View 404, View 403 Func to ControllerClass

# Improvement :
- Home :
  - Carousel Images
  - Filter Category
  - Search Ajax
  - Product Detail Page
- Admin :
  - Product Filter Category
  - Desription Tooltip
  - Nested Category
- System :
 - Router Class :
   - Define constructor in App/ClassController, force to index or error 404 if method not exist
   - Sequence Router URI:
     - NO-URI : IndexClass:indexMethod
     - URI :
       - AnotherClass/methodName/...params,
       - AnotherClass::indexMethod/...params,
       - # LOOP START
       - Directory/AnotherClass/methodName/...params,
       - Directory/AnotherClass::indexMethod/...params,
       - Directory/...Directory
       - # LOOP DONE
       - IndexClass::indexMethod/...params
 - Input Request Validation
 - Database Class Query Builder
