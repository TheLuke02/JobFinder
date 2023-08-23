# ESAME DI STATO DI ISTITUTO TECNICO 2020/2021 La Spina Luca Ⅴ°E
**Indirizzo: INFORMATICA E TELECOMUNICAZIONI (Nuovo ordinamento)**

**Articolazione: INFORMATICA**


**Tema interdisciplinare materie d’indirizzo:
INFORMATICA, GPOI, SISTEMI E RETI, TPSI**

## Realtà di riferimento:
È stata richiesta l’implementazione di una WEB-APP per la gestione degli annunci lavorativi. L’azienda
richiedente, ovverosia JobFinder, è un’azienda che fa da intermediaria tra i candidati e un’azienda
durante lo svolgimento dei colloqui. Difatti, essa seleziona candidati con requisiti corrispondenti a
quelli richiesti da una specifica inserzione creata dalle aziende. Fino ad ora, l’azienda ha sempre
lavorato con il cartaceo, inserendo gli annunci su giornali, gazzette, ecc. Con l’obiettivo di espandersi,
è stata richiesta la realizzazione di una WEB-APP con la possibilità di creare due account diversi:
l’account Aziendale e l’account Utente. Inoltre, all’interno della WEB-APP bisognerà dare la possibilità
alle aziende di creare delle inserzioni lavorative e agli utenti di poterle salvare tra i “Preferiti”.
In questo modo, non appena l’utente si presenterà nell’ufficio dell’azienda si potrà iniziare
immediatamente il colloquio. Per poter raggiungere l’obiettivo richiesto dall’azienda si è pensato di
strutturare la WEB-APP con le seguenti pagine fondamentali:

• Homepage

• Pagina di registrazione (aziendale ed utente)

• Area personale (sia per l’account aziendale che per quello utente)

• Pagina di ricerca (all’interno della quale si potranno salvare le inserzioni preferite)

![Prima immagine](https://github.com/TheLuke02/JobFinder/blob/main/image/image-000.png)

## DIAGRAMMA DI GANTT:
Per poter raggiungere l’obiettivo prefissato si è pensato di realizzare un Gantt Project, esso è un
grafico che pianifica le attività lavorative nel tempo. Il grafico che andrò a presentare sarà una
simulazione di quello che potrebbe essere il Gantt Project del mio progetto: JobFinder. 

![Diagramma di GANTT del progetto](https://github.com/TheLuke02/JobFinder/blob/main/image/image-001.png)

Ho raggruppato il progetto in in 4 fasi fondamentali:

• Concezione (È la fase in cui bisogna prevedere i vincoli e le opportunità)

• Definizione (Si imparano e definiscono le tecnologie da utilizzare)

• Realizzazione (Si realizza praticamente ciò che si è pensato in fase di Concezione e Definizione)

• Chiusura (In questa fase del progetto si testa che il sito funzioni correttamente)

## ANALISI:
Per poter adempiere alle richieste dell’azienda bisognerà creare due account diversi all’interno della
WEB-APP, l’account utente e quello aziendale, per gestire questa situazione si è pensato di creare due
entità: l’entità “Utenti” e l’entità “Aziende”. La prima avrà al suo interno una chiave primaria per poter
identificare in modo univoco ogni utente che si registrerà all’interno del sito, lo stesso ragionamento
varrà anche per l’account aziendale. All’interno di queste due entità avremo degli attributi che andranno
ad aggiungere varie informazioni relative a tutto ciò che concerne il tipo di account, per esempio,
nell’Entità “Utenti” avremo tutte le informazioni necessarie per poter identificare un individuo come:
nome, cognome, codice fiscale, residenza (che sarà composta da diversi attributi), email, luogo e la data
di nascita. La stessa cosa varrà per l’entità “Aziende”, infatti, avremo tutto il necessario per poterla
identificare proprio come nell’entità “Utenti”: nome, numero di dipendenti, sede legale (anch’essa
composta da vari attributi), email e recapito telefonico per poter contattare l’azienda. Per poter
conservare le varie inserzioni si è pensato di creare un’entità “Inserzioni” con al suo interno una chiave
primaria (IDInserzione) così da poter distinguere in modo univoco un’inserzione da un’altra, in aggiunta,
avremo anche la chiave primaria dell’entità “Aziende” all’interno dell’entità “Inserzioni” come chiave
esterna, in modo tale da poter sempre risalire a quale azienda appartiene l’inserzione. All’interno di
questa entità avremo, dunque, i seguenti attributi: titolo, salario, descrizione, figura ricercata, anni
di esperienza, titolo di studio e il tipo di contratto. Per quanto riguarda le inserzioni preferite
dall’utente si è pensato di utilizzare l’associazione molti a molti (M/N) “Preferiscono” tra le entità
“Utenti” e “Inserzioni”, poiché, essendo un’associazione di grado molti a molti, essa diventerà un’entità
per via delle regole di mapping, con al suo interno le chiavi primarie delle entità “Utenti” ed
“Inserzioni”, che diverranno chiavi esterne su Preferiscono componendo così la chiave primaria. In questo
modo, tramite le chiamate SQL potremo, partendo dall’entità “Preferiscono”, risalire all’inserzione e
all’azienda creatrice della stessa. Di conseguenza, le regole di lettura saranno le seguenti:

• Un utente può preferire diverse inserzioni ed un’inserzione può essere la preferita di svariati
utenti.

• Un’azienda può creare molteplici inserzioni, mentre un’inserzione è creata da una sola azienda.

### Schema logico-relazionale:

• Utenti(**IDUtente**, Nome, Cognome, CF, TelefonoUtente, EmailUtente, PasswordUtente, DataNascita,
LuogoNascita, RegioneUtente, CAPUtente, CittaUtente, ViaUtente, ProvinciaUtente)

• Preferiscono(**<ins>IDInserzione</ins>**, **<ins>IDUtente</ins>**)

• Inserzioni(**IDInserzione**, <ins>IDAzienda</ins>, Salario, DescrizioneInserzione, Titolo, FiguraRicercata,
AnniEsperienza, TipoContratto, StudioMinimoRichiesto)

• Aziende(**IDAzienda**, NomeAzienda, EmailAzienda, PasswordAzienda, TelefonoAzienda,
DescrizioneAzienda, NDipendeneti, RegioneAzienda, CittaAzienda, ViaAzienda, CAPAzienda,
ProvinciaAzienda)

### Diagramma UML:
“Utenti” e “Inserzioni”, poiché, essendo un’associazione di grado molti a molti, essa diventerà un’entità
per via delle regole di mapping, con al suo interno le chiavi primarie delle entità “Utenti” ed
“Inserzioni”, che diverranno chiavi esterne su Preferiscono componendo così la chiave primaria. In questo
modo, tramite le chiamate SQL potremo, partendo dall’entità “Preferiscono”, risalire all’inserzione e
all’azienda creatrice della stessa.

![Diagramma UML del DB](https://github.com/TheLuke02/JobFinder/blob/main/image/image-004.png)
