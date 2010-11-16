-- phpMyAdmin SQL Dump
-- version 2.11.7-rc1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 05, 2008 at 10:49 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `stikked`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL default '0',
  `ip_address` varchar(16) NOT NULL default '0',
  `user_agent` varchar(50) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL default '0',
  `session_data` text NOT NULL,
  PRIMARY KEY  (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE IF NOT EXISTS `languages` (
  `code` varchar(12) character set utf8 collate utf8_unicode_ci NOT NULL,
  `description` varchar(32) character set utf8 collate utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`code`, `description`) VALUES
('abap', 'ABAP'),
('actionscript', 'ActionScript'),
('actionscript3', 'ActionScript 3'),
('ada', 'Ada'),
('apache', 'Apache configuration'),
('applescript', 'AppleScript'),
('apt_sources', 'Apt sources'),
('asm', 'ASM'),
('asp', 'ASP'),
('autoconf', 'Autoconf'),
('autohotkey', 'Autohotkey'),
('autoit', 'AutoIt'),
('avisynth', 'AviSynth'),
('awk', 'awk'),
('bash', 'Bash'),
('basic4gl', 'Basic4GL'),
('bibtex', 'BibTeX'),
('blitzbasic', 'BlitzBasic'),
('bnf', 'bnf'),
('boo', 'Boo'),
('bf', 'Brainfuck'),
('caddcl', 'CAD DCL'),
('cadlisp', 'CAD Lisp'),
('c', 'C'),
('cpp', 'C++'),
('csharp', 'C#'),
('cfdg', 'CFDG'),
('cil', 'CIL'),
('clojure', 'Clojure'),
('c_mac', 'C (Mac)'),
('cmake', 'CMake'),
('cobol', 'COBOL'),
('cfm', 'ColdFusion'),
('cpp-qt', 'C++ (QT)'),
('css', 'CSS'),
('cuesheet', 'Cuesheet'),
('dcs', 'DCS'),
('d', 'D'),
('delphi', 'Delphi'),
('diff', 'Diff'),
('div', 'DIV'),
('dos', 'DOS'),
('dot', 'dot'),
('ecmascript', 'ECMAScript'),
('eiffel', 'Eiffel'),
('email', 'eMail (mbox)'),
('erlang', 'Erlang'),
('fsharp', 'F#'),
('fo', 'FO (abas-ERP)'),
('fortran', 'Fortran'),
('freebasic', 'FreeBasic'),
('4cs', 'GADV 4CS'),
('gambas', 'GAMBAS'),
('gdb', 'GDB'),
('genero', 'genero'),
('genie', 'Genie'),
('glsl', 'glSlang'),
('gml', 'GML'),
('gettext', 'GNU Gettext'),
('make', 'GNU make'),
('gnuplot', 'Gnuplot'),
('groovy', 'Groovy'),
('gwbasic', 'GwBasic'),
('haskell', 'Haskell'),
('hicest', 'HicEst'),
('hq9plus', 'HQ9+'),
('html4strict', 'HTML'),
('chaiscript', 'ChaiScript'),
('icon', 'Icon'),
('ini', 'INI'),
('inno', 'Inno'),
('intercal', 'INTERCAL'),
('io', 'Io'),
('java', 'Java'),
('javascript', 'Javascript'),
('java5', 'Java(TM) 2 Platform Standard Edition 5.0'),
('j', 'J'),
('jquery', 'jQuery'),
('kixtart', 'KiXtart'),
('klonec', 'KLone C'),
('klonecpp', 'KLone C++'),
('latex', 'LaTeX'),
('lisp', 'Lisp'),
('locobasic', 'Locomotive Basic'),
('logtalk', 'Logtalk'),
('lolcode', 'LOLcode'),
('lotusformulas', 'Lotus Notes @Formulas'),
('lotusscript', 'LotusScript'),
('lscript', 'LScript'),
('lsl2', 'LSL2'),
('lua', 'Lua'),
('magiksf', 'MagikSF'),
('mapbasic', 'MapBasic'),
('matlab', 'Matlab M'),
('mpasm', 'Microchip Assembler'),
('reg', 'Microsoft Registry'),
('mirc', 'mIRC Scripting'),
('mmix', 'MMIX'),
('modula2', 'Modula-2'),
('modula3', 'Modula-3'),
('m68k', 'Motorola 68000 Assembler'),
('mxml', 'MXML'),
('mysql', 'MySQL'),
('newlisp', 'newlisp'),
('nsis', 'NSIS'),
('oberon2', 'Oberon-2'),
('objc', 'Objective-C'),
('ocaml-brief', 'OCaml (brief)'),
('ocaml', 'OCaml'),
('pf', 'OpenBSD Packet Filter'),
('oobas', 'OpenOffice.org Basic'),
('oracle11', 'Oracle 11 SQL'),
('oracle8', 'Oracle 8 SQL'),
('oxygene', 'Oxygene (Delphi Prism)'),
('oz', 'OZ'),
('pascal', 'Pascal'),
('pcre', 'PCRE'),
('perl', 'Perl'),
('perl6', 'Perl 6'),
('per', 'per'),
('php-brief', 'PHP (brief)'),
('php', 'PHP'),
('pic16', 'PIC16'),
('pike', 'Pike'),
('pixelbender', 'Pixel Bender 1.0'),
('plsql', 'PL/SQL'),
('postgresql', 'PostgreSQL'),
('povray', 'POVRAY'),
('powerbuilder', 'PowerBuilder'),
('powershell', 'PowerShell'),
('progress', 'Progress'),
('prolog', 'Prolog'),
('properties', 'PROPERTIES'),
('providex', 'ProvideX'),
('purebasic', 'PureBasic'),
('python', 'Python'),
('qbasic', 'QBasic/QuickBASIC'),
('q', 'q/kdb+'),
('rails', 'Rails'),
('rebol', 'REBOL'),
('robots', 'robots.txt'),
('rpmspec', 'RPM Specification File'),
('rsplus', 'R / S+'),
('ruby', 'Ruby'),
('sas', 'SAS'),
('scala', 'Scala'),
('scilab', 'SciLab'),
('sdlbasic', 'sdlBasic'),
('scheme', 'Scheme'),
('smalltalk', 'Smalltalk'),
('smarty', 'Smarty'),
('sql', 'SQL'),
('systemverilog', 'SystemVerilog'),
('tcl', 'TCL'),
('teraterm', 'Tera Term Macro'),
('text', 'Plain Text'),
('thinbasic', 'thinBasic'),
('tsql', 'T-SQL'),
('typoscript', 'TypoScript'),
('unicon', 'Unicon (Unified Extended Dialect of Icon)'),
('idl', 'Uno Idl'),
('vala', 'Vala'),
('vbnet', 'vb.net'),
('verilog', 'Verilog'),
('vhdl', 'VHDL'),
('vim', 'Vim Script'),
('vb', 'Visual Basic'),
('visualfoxpro', 'Visual Fox Pro'),
('visualprolog', 'Visual Prolog'),
('whitespace', 'Whitespace'),
('whois', 'Whois (RPSL format)'),
('winbatch', 'Winbatch'),
('xbasic', 'XBasic'),
('xml', 'XML'),
('xorg_conf', 'Xorg configuration'),
('xpp', 'X++'),
('z80', 'ZiLOG Z80 Assembler');

--
-- Table structure for table `pastes`
--

CREATE TABLE IF NOT EXISTS `pastes` (
  `id` int(10) NOT NULL auto_increment,
  `pid` varchar(8) character set utf8 collate utf8_unicode_ci NOT NULL,
  `title` varchar(32) character set utf8 collate utf8_unicode_ci NOT NULL,
  `name` varchar(32) character set utf8 collate utf8_unicode_ci NOT NULL,
  `lang` varchar(32) character set utf8 collate utf8_unicode_ci NOT NULL,
  `private` tinyint(1) NOT NULL,
  `paste` longtext character set utf8 collate utf8_unicode_ci NOT NULL,
  `raw` longtext character set utf8 collate utf8_unicode_ci NOT NULL,
  `created` int(10) NOT NULL,
  `expire` int(10) NOT NULL default '0',
  `toexpire` tinyint(1) unsigned NOT NULL,
  `replyto` varchar(8) character set utf8 collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=154 ;
