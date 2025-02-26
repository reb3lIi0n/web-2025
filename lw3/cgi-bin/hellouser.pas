PROGRAM HelloUser(INPUT, OUTPUT);

USES
  DOS;

VAR
  QueryString, Name, IsItName: STRING;
  PosName: INTEGER;
BEGIN
  WRITELN('Content-Type: text/plain');
  WRITELN;
  QueryString := (GetEnv('QUERY_STRING') + ' ');
  PosName := Pos(' ', QueryString);
  IsItName := Copy(QueryString, 1, 5);
  IF IsItName = 'name='
  THEN
    Name := Copy(QueryString, 6, PosName - 6);
  IF Name = ''
  THEN
    Name := 'Anonymous';
  WRITELN('Hello dear, ', Name, '!');
END.