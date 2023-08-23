/* Creazione tabelle */
CREATE TABLE Utenti(
  IDUtente                INT         NOT NULL,
  Nome                    VARCHAR(30) NOT NULL,
  Cognome                 VARCHAR(30) NOT NULL,
  CF                      VARCHAR(20) NOT NULL,
  TelefonoUtente          VARCHAR(15),
  EmailUtente             VARCHAR(50) NOT NULL,
  PasswordUtente          VARCHAR(50) NOT NULL,
  DataNascita             DATE        NOT NULL,
  LuogoNascita            VARCHAR(50) NOT NULL,
  RegioneUtente           VARCHAR(50) NOT NULL,
  CAPUtente               INT         NOT NULL,
  CittaUtente             VARCHAR(50) NOT NULL,
  ViaUtente               VARCHAR(50) NOT NULL,
  ProvinciaUtente         VARCHAR(50) NOT NULL,
  CONSTRAINT  UtentePK    PRIMARY KEY(IDUtente)
);

CREATE TABLE Aziende(
  IDAzienda               INT         NOT NULL,
  NomeAzienda             VARCHAR(30) NOT NULL,
  EmailAzienda            VARCHAR(50) NOT NULL,
  PasswordAzienda         VARCHAR(50) NOT NULL,
  TelefonoAzienda         VARCHAR(15) NOT NULL,
  DescrizioneAzienda      TEXT(500)   NOT NULL,
  NDipendenti             INT         NOT NULL,
  RegioneAzienda          VARCHAR(50) NOT NULL,
  CittaAzienda            VARCHAR(50) NOT NULL,
  ViaAzienda              VARCHAR(50) NOT NULL,
  CAPAzienda              VARCHAR(50) NOT NULL,
  ProvinciaAzienda        VARCHAR(50) NOT NULL,
  CONSTRAINT  AziendaPK   PRIMARY KEY(IDAzienda)
);

CREATE TABLE Inserzioni(
  IDInserzione            INT         NOT NULL,
  IDAzienda               INT         NOT NULL,
  Salario                 FLOAT       NOT NULL,
  DescrizioneInserzione   TEXT(500)   NOT NULL,
  Titolo                  VARCHAR(20) NOT NULL,
  FiguraRicercata         VARCHAR(30) NOT NULL,
  AnniEsperienza          INT         NOT NULL,
  TipoContratto           VARCHAR(50) NOT NULL,
  StudioMinimoRichiesto   VARCHAR(50) NOT NULL,
  CONSTRAINT  InserzionePK          PRIMARY KEY(IDInserzione),
  CONSTRAINT  AziendaInserzioneFK1  FOREIGN KEY(IDAzienda)  REFERENCES Aziende(IDAzienda)
);

CREATE TABLE Preferiscono(
  IDInserzione            INT         NOT NULL,
  IDUtente                INT         NOT NULL,
  CONSTRAINT PreferisconoFK1PK FOREIGN KEY(IDInserzione) REFERENCES Inserzioni(IDInserzione),
  CONSTRAINT PreferisconoFK2PK FOREIGN KEY(IDUtente) REFERENCES Utenti(IDUtente)
);


/* Schema logico relazionale. */
Utenti(IDUtente, Nome, Cognome, CF, TelefonoUtente, EmailUtente, PasswordUtente, DataNascita, LuogoNascita, RegioneUtente, CAPUtente, CittaUtente, ViaUtente)
Aziende(IDAzienda, NomeAzienda, EmailAzienda, PasswordAzienda, TelefonoAzienda, DescrizioneAzienda, NDipendenti, RegioneAzienda, CittaAzienda, ViaAzienda, CAPAzienda)
Inserzioni(IDInserzione, IDAzienda, Salario, DescrizioneInserzione, Titolo, FiguraRicercata, AnniEsperienza, TipoContratto, StudioMinimoRichiesto)
Preferiscono(IDInserzione, IDUtente)