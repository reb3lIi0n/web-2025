PROGRAM WorkWithQueryString(INPUT, OUTPUT);
USES
  DOS;

FUNCTION GetQueryStringParameter(Key: STRING): STRING;
VAR
  QueryString, Temp: STRING;
  Pos1, Pos2: INTEGER;
BEGIN
  QueryString := (GetEnv('QUERY_STRING'));
  Pos1 := Pos(Key, QueryString);
  IF Pos1 = 0
  THEN
    EXIT('');
  Temp := Copy(QueryString, Pos1, Length(QueryString));
  Pos1 := Pos('=', Temp) + 1;
  Temp := Copy(Temp, Pos1, Length(Temp));
  Pos2 := Pos('&', Temp);
  IF Pos2 <> 0
  THEN
    GetQueryStringParameter := Copy(Temp, 1, Pos2 - 1)
  ELSE
    GetQueryStringParameter := Copy(Temp, 1, Length(Temp))
END;

BEGIN
  WRITELN('Content-Type: text/plain');
  WRITELN;
  WRITELN('First Name: ', GetQueryStringParameter('first_name'));
  WRITELN('Last Name: ', GetQueryStringParameter('last_name'));
  WRITELN('Age: ', GetQueryStringParameter('age'));
  WRITELN('Something else: ', GetQueryStringParameter('something_else'))
END.