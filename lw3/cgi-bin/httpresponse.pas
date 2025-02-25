PROGRAM HttpResponse(INPUT, OUTPUT);
USES
  DOS;
VAR
  QUERY_STRING: STRING;
BEGIN
  WRITELN('Content-Type: text/plain');
  WRITELN;
  WRITELN('REQUEST_METHOD:', GetEnv('REQUEST_METHOD'));
  WRITELN('QUERY_STRING:', GetEnv('QUERY_STRING'));
  WRITELN('CONTENT_LENGTH:', GetEnv('CONTENT_LENGTH'));
  WRITELN('HTTP_USER_AGENT:', GetEnv('HTTP_USER_AGENT'));
  WRITELN('HTTP_HOST:', GetEnv('HTTP_HOST'));
  IF GetEnv('QUERY_STRING') = 'lanterns=1'
  THEN
    WRITELN('The British are coming by land.')
  ELSE
    IF GetEnv('QUERY_STRING') = 'lanterns=2'
    THEN
      WRITELN('The British are coming by sea.')
    ELSE
      IF GetEnv('QUERY_STRING') = 'lanterns=3'
      THEN
        WRITELN('The British are coming by air')
      ELSE
        WRITELN('The North Church shows only ''', GetEnv('QUERY_STRING'), '''.')
END.