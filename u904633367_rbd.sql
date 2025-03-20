-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 17, 2024 at 12:05 PM
-- Server version: 10.11.7-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u904633367_rbd`
--

-- --------------------------------------------------------

--
-- Table structure for table `addrs`
--

CREATE TABLE `addrs` (
  `id` int(10) UNSIGNED NOT NULL,
  `address` varchar(550) NOT NULL,
  `alias` varchar(250) NOT NULL,
  `ccy` varchar(250) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `id` int(10) UNSIGNED NOT NULL,
  `agent_name` varchar(550) NOT NULL,
  `agent_title` varchar(550) NOT NULL,
  `agent_desc` text DEFAULT NULL,
  `agent_gender` varchar(550) DEFAULT NULL,
  `agent_exp` varchar(550) DEFAULT NULL,
  `agent_url` varchar(550) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `apireq`
--

CREATE TABLE `apireq` (
  `ID` int(20) UNSIGNED NOT NULL,
  `email` varchar(320) DEFAULT NULL,
  `actiondone` varchar(320) DEFAULT NULL,
  `req` text DEFAULT NULL,
  `res` text DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `apireq`
--

INSERT INTO `apireq` (`ID`, `email`, `actiondone`, `req`, `res`, `date`) VALUES
(1, 'support@vivamarketsonline.com', 'ReCaptcha Verify', 'secret=6LefNr0pAAAAAKnHi2YVvpq-XHCSh69zssAlon7d&response=', '{\n  \"success\": false,\n  \"error-codes\": [\n    \"invalid-input-response\"\n  ]\n}', '2024-04-16 16:45:09'),
(2, 'support@vivamarketsonline.com', 'ReCaptcha Verify', 'secret=6LefNr0pAAAAAKnHi2YVvpq-XHCSh69zssAlon7d&response=03AFcWeA4Fyf0948fMbCgpd2aN0eYXPQDJpwI-QamJ57WNJL3BIUtnHMmT7hu4f0zGKt3xnL6OPU-WwL1UMuapq8H-HCq41NByyvA4fWrf54z5MbAF2qBnmDyy8GGQe66DO9MHGoIhfQjHzIZvtLt4W-nYa9rBYfL8-v2eO_XjYtxqUJ-lfFEiQQa68AaX3D05aMkrXVOEjlOzRVaP6QFAv7HZYjWtITAC8Q-AW11f_E94ZYITHx5NmU2s2NOYBTeTcdbmst2jzblAi5Uo3wdMu8M8oQa_N7cvHiXxDgGea8zaaCHi4ea8cGtViaLZSfNJsa3uv38pc3LKhK2LjTE9Ja7b4GzXrQYnPAYoGVN_sk1T0ZOWkzAfFZRYrxB4MqiVbN2TepkqgIgTcKXHRl-aRecf5zoIiqjeKBWkO2yeaabgntQ-92BOqRMwQhItW8vZshWizdRfJ4wxM99vofJN0g2uojDEi9WcbNm6ftdeamyy_G19hVqBxLK1jC4hIWty2nuQ3kVtDOx49NTwGqDPVYlMDTrV933yoO2ruVxU9nnWprwudtygpeyegyReAi6TkHBMs0jS5OcUX5kwSGHQoyKOfU2KxGvK2jxz2Bn9AfYAIYSDCjA1-qUeSjL8A0oPiR-tzQMtMagkrE8AEXJdAjrGmwIUOeA5S-2cFFm_-BWJ0IDfWgnRPB__VO4j4d0ahYv9IS3H-_uuVH-0hs_D9dj4b0B8_b3gzFu1cRkZfcX0w3jjcpOmxhIsQKnyCdks5I2meaZF7EJtQbaslgoR2UcNRnTI5BH4_XGp1lEBjGBaa437_-IhjNrETBLYNgJ27BvU7VX__KmJVqSNGI5EGr7eL6-PZCfO0DPz85naNuEilp28ntLQ-gVszoyiplt_6V7lKwviJVqiPSAygz0oyTFOnHd2tNecGNq_aQ-07mAaxVARISYL9IFSWlMazykdJbWo9RCSR70vLhfitKSEubObdK7Gg8TQCzLiqDBVepqhIp-G-UlBR2q3jqLVu93CxMZm_C74zezQRM-i7_Q4FL6-AxonrRjgdIovMqeUjbPuDWeV_KRAf4fG-YBvJslmy8IqUWoS3OMvHwtgm0wBU9FLgJtOQB7rK_sEy6RU2ri18fSFojw3qgtp7S_hwomZPHTJCoZE1BOQ18PnguF3L6MW73UVWqNVLVXHZFOAbshvKNPyvXk_UzR5dqFkYTCHh7O7bQbL0l9qgVY5Y6BwxDMu7mpZxkmmp2BzEwyrKJRsDtjO8hUbL8uX-94a7k7NG_4AFARGiZ2lVBRC9HI3CJaCdcPLSQbBkggAfjoF9abwdMj01baq3UiDF6OWtvanVSdL9-PR_x7UrvW-EhH4aZxvYM15vdd8iClWtZ23Ibrdqj0Au0OpsgzT9l3dIYMHthTUmz-gZdDb2s4dvprt0QSseqM2lFhsZTeMCndqHG6yD_vY6UCsfrNb8vdGJgrHRuW3mwa4wn0bIO-69pz4lcLQm3s0GRsOkkXWcxlbtJ-DDrgTd03YAlZu62AYK-zV4Net6oXEx5yPy_DKhbGDg-xpI0iSxBf8VZxjbj-JwoQR-kqzjPt460t9XfzXa6x0OEdC_k4kJLBDzDBDJkv6IAdB5vP-IKyuyAop0m1Y7YNxErlDp6U-4MKSNRwT0t6cwY205yCEZt0VPPVVOE-ReeuAFxQYQsWGwo_rm8qJF3IGiBG5rtXwE6RomHvbmH4c42uHvV7Va2f88WUb06oux9RkEPT9XAjFcvXrGjCHf3XApYUc9x7sW4w', '{\n  \"success\": true,\n  \"challenge_ts\": \"2024-04-16T16:45:10Z\",\n  \"hostname\": \"Chargebackbase.com\"\n}', '2024-04-16 16:47:16'),
(3, 'support@vivamarketsonline.com', 'ReCaptcha Verify', 'secret=6LefNr0pAAAAAKnHi2YVvpq-XHCSh69zssAlon7d&response=', '{\n  \"success\": false,\n  \"error-codes\": [\n    \"invalid-input-response\"\n  ]\n}', '2024-04-16 16:48:14'),
(4, 'brandonwhite0@tutanota.com', 'ReCaptcha Verify', 'secret=6LefNr0pAAAAAKnHi2YVvpq-XHCSh69zssAlon7d&response=03AFcWeA4pKCMWBhj12IEmyGUFZzl08GYvfEt4852GL6PcSrg3XHgJhNX6Abory1R54rWmQXmk1YmccQYEfk2UjuLEYXDDCRCDxITGt9jGMhWOx1g5kdkBofh57uUBl5byxXQDl6NnxazFWYdlg3fnBpergRtqu2-Ik99ZkBbUXug1x8_3SodaYqzGliI9RET8-pyw_odCRkOyR1X0mAEfFMFSfuhaTO_1smo_VeiCXvhik06PP7Y7424ukDrZfU9Z8EszwXBraHDoxG2NKjkr4ywnd4QCVp8pfdbho_SHJ_gTw560X42-JDLe6nUnnqyXYvRAiiQ8XHjqn3gossE3OMEx8K2bixRAPyNgaioQlxfLSxnUuDbjwynoc4zevCiZLeq4GAqYVqI8enlhPpWoix8hEc3Rz8mGKK-cV10p5s6KhEZTMaOPuYtfhvBHUExt4CUFRAgeJ7DmNFovbVun8C6rG4f3dwzApOxP-aoVHjTJluqUCF3ysSZvyxRMqMyhf9dxqAwwq3sM0dvBHw0eniuGiE-s6ZHbFPJ0-OwrsDjQtJeclr0gLVQnJniqpr9VXzKawMtRfRAQCfRkv180KZF-yak5DdDTHizoGgfTRWnvEk0HECAhvTSCjDB6_frmeosB8odHSiJrdhGxJNRe6OZkXwtzvB4UtU-ovEX0y7f6euwrieimS4V9rY4OPb59Hy4wQB0tgrQeXs5cQg6KyKdwLRiKIAHNchlzOAAtIVykQnMkLPdpvNVjPhunKahANkGk9mLYVj7E83dzBtlq75zIWS9IUnY5lKLWwZfZejDm1X5O35BVNNV5lx2W4yphS-D1zej14HPP4Lm9--nKGvqf3Npk0_2R_hbyDUEm7udcZmO5rzBjMf5SvE1yPTi9SAuS_gQH0vhgZjUCLM0ErjtX_ZbA-Z5qTIYj1yC5KVK-tI0G6HEB73dNiofL90nRtjEqHv6K2xuiZ9SpQ_E4GvcxwSdGWulB4WQvE8ghP6SaDRBRah6zIjVvZQCU6BIDUjOLKLwBmKo6FgsW-EnU2DQIohQ5_iTe7UexbaGwBhKwwqz4kH4Lv5mNy6BgD8Gwy6bw4bYtIJbOCVcOHQhKMUEDXU4UWFeVBEpSvxWGheThWdzHKJROehKv3PrNbc_trkhAYejZPbxu05Ts7pDqtCyYmzKnLM2f_M1qQa_gR4vpUpHGJVUEaks_6MJL1TnV3iGTNs5pobTJqAuQUme5jdtumYabpCi9WxBcQYADit43pP-5sEv_5Ig1fdpGyE2-9ArdEvUiOtSdsQuCnMXOgRMGh5Q-Z4yb5FBtBbpH2uRAFlW55KuY1OBOxZBP4YIV90BuPsfMTrlJpZVoaAUg4ISvA0DH0Vm6WImGJdF-xOHpygz30osDZLvOjl1x7y7RXHdfsRuJuAC-co-gquOQoKslTHaDLjKBReNKEnnysKgCsFYa2Wuz4Pf3kVt7l4OjtBf7sxtM3rwq5o5KXTdeunP_KaxQZ4b77fi3ZC8LG-SWTEZCcn_4szzHR0nHREmVB531FQSIDdhh_FPPWwcccZMWIGu_OraV2cLmqU97bikggcigh0-Lf5Zp-z1dSw0IWYgqLjv19D_tvnerbS3LVBfdQUshEztaDbvpK-ChX1PMyz8aFN1ND3cNb7McOzbORdCrRzq8PRQpwCVrvjhNEt6ywNjUNxQrsfHZzw_XRkxO2aeL7fXrymBvONlnH0OcXFFNqUKRh3ZyGxWKVPSimOkyDVJ5QZf0_B4bsLuV_lOR0fzEivrGa6i0dEuDuTP4ZVIo6ytNTgjodAHPntC4IfVEd6RQD14segmLD86KhPtZZJeMu_uqcz7oZFamHnxJ-C5gMtlWQF05N9oyaS3kzg9czHCg2oJ1oR2-u19E0-pvXJ_AF8jliYrvCKCXNGmKNZPR0bcn7Vb-oLtYiddBqxz7tfWoPLgr4APeLlOrpu8KMTdOQMQlIB42zRNP6tOlRYc6lvEKEZzVTXWSfqjxaZ_JP_tsMHEw_AYjn79FQmzFh9XwEsncQQPSJitTyY92ezeqd_KJEe-Q', '{\n  \"success\": true,\n  \"challenge_ts\": \"2024-04-17T05:15:54Z\",\n  \"hostname\": \"Chargebackbase.com\"\n}', '2024-04-17 05:16:27'),
(5, 'support@vivamarketsonline.com', 'ReCaptcha Verify', 'secret=6LefNr0pAAAAAKnHi2YVvpq-XHCSh69zssAlon7d&response=03AFcWeA5hYM5CYPwpxSe4rIqwgB_6HZmpOGXk5Ytxk9c9pcPYQyDpJTQWFb9rxKbINcmwU4Rt8Pk8ivSMwtb6WeuXQt5TTNTpK8C12De-8C5YlPcpQwnWvjL-0p4cNB1rv8aXsqjflL3AKuFsz1vSMrHfpBl4J-gPHHB-qhWYch-LJIce88Kx7AJqBJ5SQAt_8gOanWaSInGTEKv2bC7H39Tl9vbzwet-HGM0PxxmcxTBS2FWKmHwHGesqAgXx2M4Stc-Ak6FpfT3MF9_pEqz2pvojLR90wGNs0ONJwy1SvFsU2W0O516DCJgceKzdkNDLk6W3sl7PJ5TQ3zE-xdp4LTSjwpoNH3q6jOcCesarvK_vYhbagntypUGUy-3B4FIXlgtMOrqcVQLGApfddJ4qN7eaETZrJd2PyE9Vx7TK_liWKuaEWOwj3Svs2dKQxq-spH07ZcWedT0JoklfgdymnKokFG0jHNXKz2Z5BLtYNcrx5zgZkLnqPfEbIbIP1_59G1WlJ9mw_QAk7-ggCGIzgaClFSYL5nTYkTRoxtonhgCJbb_saGWIOGxNsKzAq-kXJsiZoP9iq9ihUQ0KY4mou7ciYds8djeYmDqc76uLEIMs_5R864DgI-7Lj4xXfA_D8mTZWVLzx5nNNlAqzCjEMcFHl0OT7t-PinDD_nB90AmPVowQtx4F8Rk8dFrTsvQntjd2ixgBMoovYTp2uqw3uPHGJ5RHKyYFb8VhrDFIo3C_FI9bUoUNcbfO63hy0gz6atgjpCZiAlpDk4m62CAQeSgwMIDXjQsQF0OLXfC54V7OG8QLjjk0I2j93RUH0wJEZoo1Q-mHHCvAk0pH7-32hY_mwGGHRZmsKcvamXs3xvUQjRLFXaKu-LhfGZizmtWMgEHWuLAMS2vEQGCG00sAoeueqKTc6QUKX71Mt_j24o2hAERMbEXl0Tgpk2BZFZlDs2f7BnpHaOGiqGNw9zxhaKw4_r6B3wZMN_Bl-kesAmw1q37FE_36cMEMh9y_z6dN2F8j2xiuqU7kSc9z3Z13abhXNnnMvYpWrOmPejBtAocvdy-Jl8SUaE3BElXIaFtVCF6cgkAu_0Hv-D73GVAvTTdNQ6RQVADihn62el8FT4QhpleRCzUkF64VMFgoKlEWvnjwDYjdy7SXcB78QVo8nK85tzc9sifRPP16-KwkDXtxPNHlT22kiwXCcNdyTXTyuf1GIHoc-puo0XqnRZEGr4u1yKzoPBaSwb0f173ooJ9ujukoL2DQ7Ctw7iBcHy5LrLkIOv2y37QcVXiZZ7OIPLkgd40AHO28_pflqTOiJmxJ2k3wtnrC6uJn0SFUGvqkJ1uYsrf0lrmyoDEF1hhJ3i5yrtRIXwJn1rq35khvSTjXxr6WR1IttkKEtoUUb9Nw-kNiSZV2H9ZObFS7iNN_VeuJVWwoyeJKXmjr69VH9QUCK8tDuFEsX5kYQcIyT3yDcY0V-9n052tZqTrbB0o-ln5-UZrbGytgiMQ9543krqovlSfcMH5fBxIaxE0WLd2Tn2VxfsXi6ooHOYdxD_WmOyHS9yI3ZSCWi7V1eRDTm-bAyxse7_1pV7u_7lEkNJHugpEngPV71Gxn3INlpfnMJ7dPoacZ75fkPaYEZ7-giNqo3XMy1E1qKkZpBcEMPJ7OHxl0apR6UuNuyaApHRIf6TSgDzbdhlWZ9qqy6xVC0RL09lQdSaTeQhU30jvrxkXCDcLPqLWeYqjFSrwCx_UtcmHJt26FjTKizw0mHSDydHUqPneu0v0xdkn8MVVa_lmXjxRLz_602Q60LasOoAlcRax132weGnub7JAL1JtOjon1Y0ODJ_XWOiAHWd0Fw_L7QdDUMR8Lx2fy5sjTJMS-6hjDA7NbQ0ugG7qbLRF5rumuYxeSJBa2JCrZgtCzquoYpe2RLm1Lbx1D75m9_V7n9UCqhI6PrxIuQ1hT0HqVKP76qzQPw8Fnm0wpKG-dvT-h95_EUTMZhuF', '{\n  \"success\": true,\n  \"challenge_ts\": \"2024-04-17T09:36:36Z\",\n  \"hostname\": \"Chargebackbase.com\"\n}', '2024-04-17 09:36:42'),
(6, 'support@vivamarketsonline.com', 'ReCaptcha Verify', 'secret=6LefNr0pAAAAAKnHi2YVvpq-XHCSh69zssAlon7d&response=03AFcWeA4NXRQmyWAlTmMswKvWEULWGv_WJSlR5kCwMf8s_5ZZ9CUQaBOtdPV-sYRNuyxlf-iw6X5SBjqoUjwaIwvg8WG7-gyED7vOSR8tri1hVby8CoxrIAQZHbQHaX2PqT4broqXe3USWFK7DfZ6_-KQzB16m0S3_GCf8lNxWdPDAo4cwMneTFWx6YWBItPSgk70-PqFTtm2fW6Gp5cTgmxKbMha6P-NSyz2B3P3_Bt0lIFGnaxGyV_M9RY-MgVRfMO8Nqbxm3WigyfflIwprM7l1prKlqREnH_vEExMFZDXZK7Dg7syX32Wv16mjAyMC8yJLYmWPKyaXve1dbSWa2eA1C9ghH0sSTEAX-SAi_8Homr2HtUbK27Wo-zODKZrBGz1dQyuHThNDidscsxadtBUAFvu3o6tqcT4nVQnDwz_lXIrUBg32mSDuWOIpaVm8Ap51jUZQMqxlt6JQOfJzPA1nPVHtk5QkG8GIxRh7Q_P0GpMIDyz7884T-uWfNN8MlgRsKDWhCrrefvlcppu0hGnhY39YosNUPqkCeoNkiUS9uWs1tZd4QgDSRMtojFWEg72Up3bZZCKE580k7eQYT6a3CT6Z7_ZrqKwKJfxfItD6NsVFmav5Bv5edcR5t_GzhhHZXUU80RYUbnznFoAaw2sSDOcFpl9J2bJGHrBKgPcy1Jjfu3VIRHUP_M66UmEis-ltHzbSQvNR6IZFJVJYPeY66RZFNyVDIxPH6nSnlDVKyRL4awDuQHdk-gETlINPLhDD71FkWiWwQVsfS7wocdcN6Qgf8IRcNGqUwft65WeZFwpBNz_Xj_zHoz6iVYcD3Wc-0Vrapdb7HdP4J9m3lENps_zG6LhC1irn4L9EE-xjHou4LhbT2bPK2RQhLfeiCFQG1W-EXe3UI9PbE0iwNKvR2CNAk0b7HSaAcZf0TOjoMkyzAxg-w4U7l0C8mGRKQcYvbhrP0CsFi9WsSDfiaHxUtAaTY2NUoom7HzV_Gqva96Z81AVemmbuhnOPZHPvsGU_FMgggXu-Sr1BEqp_thqzeJG-oBhf0QVJM-CbgfUlS-HK1CLKt8AB7UlLr0_jvDUa4wDieRLINVUgmhgdRQtxaboudOPv-SS21-kGI22QH2tZ3oxBW0li0UmXiddhTd_tTMOrgPUNsbAaRrbyELOh9K69MhS67IHHa1tN3beyatOOBNUSLzA5KNDgoHDxaMgmSReoqY6kVV2Z0hmlCo4KyXy2qqB820-Y8AcItnveK2A_-1CuAzKx3GSc1ji6h_KYFxe6DVVlbRssvjSLSRGv0pcGXbcKPXLQaHvJKUDL042yEzYaknJiooG_AM1tsDQiIZrP9cXEGpp8pG8MON2iGHkXk4ET670zroI6JW2_d7Rxp-E6rG3BLoR4DwU9tVG_BWv_98ZL688LDKuujsDBAAOP6Qtr5CIoPIY195Hjf9VmoWvPwXVMEU1_HKFLWAl0lxI6lVDP-QHLkr8GI82rwRzaK-ZBDV3_xBRn-jvRxcY--i15epZdFIHcFSq7ZGsS7dN3IWdvBC8JLIYaFCeZO7tVlUz2BeK_DF55uISdyZWyuq81Snht30j2XX-xuq_9Urll8SxOalwe59e6po9_OHIMYa2dpTq-Csgm0WaiBTo0HbRGt8s3Iq3_F1j_pHZSYHbWIIHTGRVluIvYq--fpcvQSeX7FqQfke9IiQ2hYHFlHNA8JY', '{\n  \"success\": true,\n  \"challenge_ts\": \"2024-04-17T09:41:41Z\",\n  \"hostname\": \"Chargebackbase.com\"\n}', '2024-04-17 09:46:30'),
(7, 'support@vivamarketsonline.com', 'ReCaptcha Verify', 'secret=6LefNr0pAAAAAKnHi2YVvpq-XHCSh69zssAlon7d&response=03AFcWeA5Naj2B-fD95xulEzyaC0ruLeA7Bz14IthNpLsec1QhPyCx3r07Wh2MLjcZNbPzXpR1vdHaamv61OnWK9HENL3GRibUj91bmVU4NfVMS29ytA4GpPK3QKIqVeC2PyBUsreA46deYaNU8HAplPmyNbQkhfajEeNrCFl36YRG7Ul5Djkrxn9chQ1aiDVPN7U7JEBSt4U3SsVNLvBJOPqRn1arHw9AAIy0UB4_vEJcOJpqVZU2LMOnskASwrp2dUFe6vRz78RqnvkKb_faNA4TFthWb59vbwdvOtK-UxUdHh8yJw9ZkTBpzQ8c1peLKz0Ku-MBpIwXDMmJAinGMvkvRxGdvLDBOi2uTAxL2Au0WwJas2XSKBInI3j9LzAa3-0cSuMDDAUPFInj2Y3Nb6dJcbmfatzyKB4nJQ22fOmivSCJ3bLMBtQpHzLdpnkTUJ8TyZ81gEqOCarWvdD0BvUkP9l4TlfvOWyACPUi5-qNQawEvqp-WWgxXbbdiRVc0E51vkB8O8_HzD2fwmlWdmnAtDLQ8mAYzhq7dj0E8XLddicTNm2MHvYBukjMflVCnk4giJR_rhREUwl9rMmtW5lASZqgDSIiP5xUZFYNKiM5Obsp9HU3rKcsXbvy_vFpBAQs7px6urbMVTpnQjmnZPVnboTTUNMRxCvu-x2wVgxFcuYNpqstR6K_ki90TEh8_3C9-Vqnbd8bHltGNbgIhQL2mK70UOGrnsodGXfnzsOKWihm9nZnSJMwzvYkcM7gVj-o6ZzmW0Y6P0ZCUd0UJ3oGPf1y3t99YI677Lzn4WcujDREpSIec5FD8Nfe5Y0UQ7DWf0BhkcrSm0dNSfT5UohdsgfGG17H-3b_rmEhyUwNtfA-Agh9jbN8iNmJGa416hEx2ljdRFKgmAkXs2RibGM7ic0zUrV8u_Rdhm0nAQILAN-YZLFpltdAGHICzOckE0irssAyxfU-O1be3Nq0Qr9oKGbJuFWESygrDLfnaCntyrakJxjq2k4MnTuAPMtYNOwEBvHbSVcg8Da5Le2qT9IfnHhQwr8sjr6X1qgcGx6PnnQHixXTZWuHXBkBtZnTdhBM5hI4NXogyfYEdQMwTDJWizId5LkqeZyaWt_YkD-mWO_5m6gLM7-qpjt90SUZ9yPQ6kDC8sAAzxbPm9fGca1JFm7m7588IToI2nYYU2xJhkuULlHgqDLnzy7mfjM93iLg8aslz-9gdD4GFwnFK71EXqR0A23O0zSyMbQVkEribA0qoagGBDBEWdDt6Cyl0EAhFILAUjl-2N0-6tTcYuwaMZvNl8_yhbz2bNfxODFwBbthLUjEjfjdcWqpIjXrN0Z56cfPg1M1aeCY3_oWE3pBWHBEb6BILKzneDDKm-HcsDrpH7txvi-Ji1Z6vrxZ0OCTVEZR_ojqTGB0jCpZtIetjAEkS4DdQRpiXDSGufDtUQIkcCe-doWIQoISICbaSbfgSV5-ZG1FhWUCY3RpOoAYYUlB-w3fUa67gk4ac5qDF0_hHM9ud0P8WDczo6noE592exf6OtdwoCdDnsSabN-PJMwvPSXEH3cposGrOkXghydVKcAAqZqG-KsqIV7sUBYzWbaKiA4OkxNVfv7RHYdsMfKbFZQm6FqUNExJRU4IbHZAeLpiigM61x1jJkhor3aLn2gLXPcCVq4fXyFsa1ontpA19tELidguJLaSHOiTP_z7JTkAEo-4gSjYQsqiW8dp8xS2fOwDCVJqcx4VY4aAddNBiv9pAQ32VxpVkc5VtVuuHT8VpaMB576azjVOlSS10EZoCBfSBh-bAgfC9I2ySj8dHh0VykNiEdJq6icQco_5xmvzPtLPr3aMLzp0mTAnRm4N2P56Q3YbMcB9_tUEEGoNPNHBVUtn1zRUgQHIOAWX1zn0eCslSKfx_RftJ_FEbKjFRvb6Lre_EKOn4T67eT4wZJJDPyd8o8GQlNtYzhn-UMkU6-Rcv2fx6o8StIH3szzbCDiD9iB9Yc63l1-FpoBaDHjsrg', '{\n  \"success\": true,\n  \"challenge_ts\": \"2024-04-17T09:48:16Z\",\n  \"hostname\": \"Chargebackbase.com\"\n}', '2024-04-17 09:48:42'),
(8, 'support@vivamarketsonline.com', 'ReCaptcha Verify', 'secret=6LefNr0pAAAAAKnHi2YVvpq-XHCSh69zssAlon7d&response=03AFcWeA4NmiQIFbLmRYGCD4Z7J0Xvl5QuNoSSKqY12nfwUy-fVi_U287zFWlvybN-H9ydT_qjsilPjV_5LBXoV8dce5u1iMFcZ0OqWvn8KY73Q3tEvcVXN7Q4NFOYK6ZNitoRSRAuAU9MOXmkOlPVa_1t0Wz7Bjo2gtEEUYdH1yHW5iVuKgT5b2B9heHakqBhICFSHeIzjSdKDChVnXYnbMP3ABRrqtnmNOMdIhpRp_IL-1mWq1MYpX-6rF9SXrCxhj95esvxg6H76THGZSryazOaLGywLGy13vJJVEj2-7oO6h7FYEPoTKz-BGpYdMOYTkEYlPx76Aan-yxjih1xskjEaqXXntHqTh1J-0IdkaqlfCHARRKgrQ8fMpfTOjkTlovhuvY6cRbCdoxm3Tsy9IkcBfu5hvrq5-aKmDdg66hvO6uy7bgFKVEQBxnFkJE88gNhpasjj3woDfIBv-u8dtID_s5CSKG5nCMLzUxAAsSKPd_fBW_1qePad8NTX909JkfSYjhslz94VjY1tckjLtpgMhENCxsAyuwpWY2EsVF2FwURHQgylUaWXQKvkxwy0Z1ol2kumAgR8Vgnbetd9la5Gpv2GRKHGCkFlkVUhbBsr8m_2FpghOk92CkKc_2j26yA8RT4SNHRgA3drSfrznpaGhnYwmiqjX--nmU6sbuYixFMNoVOZRoz1rNdbLcQ5QkUuTDagjMlxgrQJC_UkTXmUz7FXc6ubzH6PmLkSie-0Zaah7D_xvRIEfOQFNwk3Q1hQel_kIoVDVZG8AsTAFzUkbt9vmV5v5lAHtWlW5pkvejgbpM2TsnB78zQY8-lWG8I556UKQg4xtn5WZicqLkgIfqOGsOpYn6mUq3X2nF2gOr7DLhUfSdtHysUkgX8r8kXbWsL6AIUjODk1SPVkMN_hr8HQF-cjkAEIHTy2gdvMaNEHyDy3yCv6-LW5wxfG_lUg2CdFDuvuNtDZS67Zn63Z6CiQQuG-Dbz-Kyqq6M-bWlkiBrGojq5Y7KNIJOIbWJP6Qc9pDL2Nj3WHRjPtYhSTXEa3p9TiftqYWJbDUIISF9j3YHOHN2k_qVb0U0SQ4715dfBfBgczgpCJv_9rNnOPCeBvP0nm98AQ-l0PuMVwFwz-IxtBihTo5EdtYDSxt-ytjv5dm2W9GY8OHd2pYWAotIek2_siTa2gKM3UFjYwWXE2xMBfD-jaR2Yrln4hv3z_cQQfC7lPbyHSxXLk2AbhbSAtJxusASjmkARrVt1SEARRqxj5L2JoHuFsirLfPeSHrtsbUtfpJqhje_Nm9wUAdu9vzpdhp1BXITcKrkZ6WGcOCKlGyTDCe1catMZV1r0W_ekDQaywTJZomUBUS67tSYY3czXOxbVksVsZ8on5kr-fnA47pMll7XIhHOIpMk4RSt3qiDQmo4dZg47vVH-B3S8XRITNpyrrB03b_YKmbUWk7LAEV04ptejlwH86_gR13K8VwNHKa5KCeK4NW33EPQOvKS3GuzELygDgt9MESMNf4NiTkQnJcOuAyljusHKF6XVVZQ4B9f8SmSY4odYNw3WNlENHNdzvpm90AkJxxJumS56nMi1TiaB1Tay-U1Ve5o3lyBUUBhKwZ3cxId1rtzbSmg_h3vphp5tD4Tc8lFBgLbMoyjn-QN2khCwN0wgLKARmhsRdK4VqIAMA8Y6bs-lHi1NDvx1mNEqvJZXO8LKvpn1LPxvhA2bP2yO28l0hK0gwkWS3LVy0f-99o2OLCmbBo0rQgReVlHSBIjD-qOOrdNSuivuIKISuNBnJiMnvEoGvqVTfYhtH3bjfGGk-QDaliOR55Oq_8hgwN5jRJ-YDh5g8Nl-xt0QVo_h3rYZUGqkZtOsCq1X6lYytK6C1G7gSKu1b0hXQVeJ4M5hpjSi6lLT-qkt4eJdJufeFfdmR1MPUMLDune560ac7cWmYJwTNqDmCBOgW5A72u4O_SlGokEy4rlcP5dOU65IYb0mZMb8Elkl', '{\n  \"success\": true,\n  \"challenge_ts\": \"2024-04-17T10:55:46Z\",\n  \"hostname\": \"Chargebackbase.com\"\n}', '2024-04-17 10:56:18'),
(9, 'support@vivamarketsonline.com', 'ReCaptcha Verify', 'secret=6LefNr0pAAAAAKnHi2YVvpq-XHCSh69zssAlon7d&response=03AFcWeA5218Yw0aghOUMhsBOjzypDaHfBq3IaTAT7dbrmkfjAG52QSIME_rrgndHzg0h1um7sqqJAzNJ_DNHuFGOk4NAFHj6THqeKT-cCvsCt8NjB7kU7kmy-2hbuKScaGjqez30DPPVxn2CHSFaksx9H2P5Zz_nunbIaKGb78RySvbBB92U0gwtOYRT9vYdjBGTSIn_WOUTMiHJYWUy5EOBPDJl7JnnBhUIM2-Ya7Nh8SQ2h7LnS2fS2wR5-gyfbvMNajAhuEB7TzbAj-me4Gzmf_g6JsNo0Vs_4f-xLcxL_-xXlKm2yNARrj9io0djRtXOgiwHBstS_ujuF-x7xaX0ldwxTkF_ppMRCGSW80S0gHIoy2uf31zuTonwMSxk2I1exU-nwrjJYnEZYS61NFNfx0c___eARFCy-0-QYKGuXUN2e0-Fv96fRnTIe6SBUoDMRQOjrn679ScDAoQc6ZRcf62tTxLbWcFSdNdVWIGtDIZCZYsgW0FiiURYRCaDjODJiAicKzyPKPcpXr3u4NmETcQoKs_uzchnqjy2wxDWLPL8PJlwOdtSgW1ioGgdA9HMq5LqpjwMpoGuUqvnk__Wd7GiqfRYi2uPVmPfVdgAnkzhVeel9HrMRhFCHDnBytUPs2XWd6YoQi-s9s_XSwH11zcKMUyn37Gx6rX8pU7Fs8sR3TpCIiXb8JH3fapHfmGVdLTs4JzSiAF9IKR82A4oSX8lXn5RLJZBQ9xprjJ4ex7XGPEA5fqCSVyIy8pkgM6LnIHYvx1lnUhD4bgX5WYSk2lfs24fkpubXWiBDw5wLlzVntPUvQMZdV_9yyBnSd0QUx79zdxLl3Jd26cUlPKe27Yv4Eebbq20Dxq-lIVDv8r4c-0o8W7hY-IHvL-BrIyK3vyWm7Gkrb1mh5vOkrkMoNOdY8vu710l-u49S9VoAKEL2_9LxqwNiwI1lMH-mSKVsRY_Btfk2soyV0-wuDstuCI2UDqyjZEJ-vn7xPet1K5WjJm0eNieTyznUqRS8zomLbiVz7UcQM7rqsB9fXbB7bLVRTNSd23NFSBIKwpi4l7tjOikIx2KugECJuEuCCpcqvLEt9orKgDrkBTY0_9y5rJELzFKe20ApB-7Gnw3X5smwMs0hy1l1hbTbcXk2WRyHXflHmFXgBBzvXV5-zcVlqCR-VmFnq_nL4dXopuxUmYYG3B5riJBRSy4OwxGEUJFm3Fykj5nM4OhOM4xdLyXOiZafMEa0Rqv-1gVQWnoZX2dE978HevvBIvWnPZ0vNX9RM8YXtz7TJlOP03jIe9y_DTx9t7UZrGau21U7b_lRobZqPS0BSxWWQ5sA5fdRZrmsJGS94ou8iEWXvv6XkZArdT57uCh4MjL6AStw8YangnqVYr6ADjQfVAwtHrY5NOeP-9EdR4c1kbTS4N7zud70SimQCgjNF9Na_EkE5JIsPhUIejuMQr-O110rJH_wEX-DJFv3-vH_zZIKv657G6t8ATI88Q7VKIQSTJ_0Jhzw8zBOoMrnoTSYQP5kdIfg8XIMGYBjQyeZNonF8KHWecYLbUIjaOAwkPqdDcdhFINMyxW1xUJ0D_7j9pDEIb4qaVFKcoTMlYlsFRZBtu6T3xoXSl1I7qX5nLt43CvYR9jCylLohkpG5sBnobgyFqLSybd2efZEqQnDsbcKPJ1afr68eurLoECap-cVOM6Qe4g94z2y0dyvncMF7OA5TRI9GVj_HBNztJDeCi46C60UAoO80J52ZoFnIlIyFxE0RW8or7dpOfTYMLYEp2STAABkTd7-So158nfqtOgIyPNg6zeg2Dok6CxOJtDNKcqaaloEuLiO6iTu4_xBnIAX5y4rwTfqKWJGRR5a4y8QBArxtFjlmxMviiIAYLiTMgZU8jl4EQiX6JyR5AgbooYz6H2Ga5mmhE79Gdpozjr_JJ8MsAq7R-bGvpAgiHTXW4Aef9IG7CRBFtZKVL4jeq8BZIcGZ6323NGVrlbqGV3sj3iWgWeBDEYQ3tLDtOyJ5GAEvwCUPuSQWFT96gM', '{\n  \"success\": true,\n  \"challenge_ts\": \"2024-04-17T11:21:18Z\",\n  \"hostname\": \"Chargebackbase.com\"\n}', '2024-04-17 11:21:47'),
(10, 'hojay27155@rartg.com', 'ReCaptcha Verify', 'secret=6LefNr0pAAAAAKnHi2YVvpq-XHCSh69zssAlon7d&response=03AFcWeA6NN3GhbeLo7NDFhEaLQ-mUeh0LjY6qdz43ND2CsOpo8vhSKm9BDD2ZOQzKv7AC3UDJzbhLZ35CLcmqJueh8KPHLjUrqLkpuI4bp1MectmTQSuwnXUkNFhgsn9FY31S3D-6ioSNbMXMjtnCOj0JveV3PRdVaTONTouEXYmOFOEvT9Uj82arx5NbWrEzEgZeZFIBeIEzDT6mrCBRY2jFU2WgXLJFJvjJSl0cVCHfKcHZX84xuL1vB2cNGTpAadGN_UHuhCPVLIhwY1TZD9xePBVcxKCs8QHmWH6ZbaZR38brGw2oz7VMRekh7yroBUEAtbNRVn69ZvHb1upbcP8GfyLzdpG_pjurXfqLhH49xaQJYjS7nO1jM8hiQeDzDfK7sHfyKe4zicUtBp74Erl-J58ahrJBxwJlE8NFqY-JnVK_lh_4dBV6wdvzNgaf8eAmonPtQy2yemSH18uP5Vxnuv0mZScuuSEJ-y8KmKM1S8yFwZKfRbTIcmOOF5k3VhorWyvz8Dx8DJGklB9x1atf30JdRnr0UibJt3eLqxvuqryYM8AKKKbJ1xjsgs6KeYwi9tQmqgn7P-rV_l9pklDRWGswrut_OUb0EhVzKeDs7hQoRt1MP27UgHeccFYp6nJJl0seJjOkz4MmycDGfuCj4q7agKed445EBS5d7UCqRGbtZvU8S5Jm-UEX70OPUoDhAFcWTbAyqoWyE7TyVHZDOfDDKjOwN0j8pTE6R38YB1VetsmWl7HJDWnpr69GqpmeWnOG4XIajhxlYvoX_5MSdOv49x7JiD5c2_WMdUCSdAAUOY69y89ZIhXdHDDRaXCTPw6ktsrRI93h2tXnJ45j8lroh2DuFU_frd2HVTu_ozXp1bIfCygn8R7fa_nCRCxFt5HhjV_Wsxd__zShCyMuV-oDMdYNAh9zhXXjj57uZjhXb9SP-iSVvAUyR_6QXvtfeTrIdfNV_0qW-Y1p7j6cJHQRfdV0UUkuqnug-kb0wu-X0bEitQhfuw6SpdZEDmX4SaDmjZzflvP7SMjO1Q3j1yZPE-uFGUOHS2fgawUQ9vMlUl2KKFBWbq3kD8znTfzkbAVg8avoc6GBJb5ErMbtkBa7Mmch7xK40Ax7WJa9agff5BQMwx2cAxltvHyQHv66h8QB_4RhBwKzYDSCOoXBn9QeTQwiKn_rPacliyqQFuStX2R2f4-eokncK2gYv6J86NI2pTLAz8D4dSYn_XAASoTz7oC_YNu5Cc--7bQClHQanGiOCyiDfSCuc3q8tF8qQrBLaDWSn6hfCrWqHsJAsNikKJ2GjT7mRhEdVFE6fr6pW4f0fWO4vcTrBf0fvAhb0ildVqR6WHYvMrW21SQpMSRFh5XHmJaO1zvPVKwCrQtMijQBC4X3OYU8xWQelLwFRfbCPxy7J3icV4L8-EDemD8mgJ1w6cbByVZx847bGC4AcokctgSB5m1e07yZH6gKJJhCE6ux4pK_T2qmxw9JhGWOl9LoYRLOvW4xlNUSUGLlljmsYNjIdBZR9hHT7FcRjtWJaSJcMs7mSEcZrBO406sPCHd-5n83Oa9BE0tcU0BpF013T8x0K8Zxs4hgh60fVOm4mAO_YA6R4c8xXrDVqVZ0zNzq0_dd55-T2gCk1V_R5dDiGP9df5F9qnJnvlutO8GWfmYovX8fDCXpIr8kVSuE_TCCtgXPtkk_otfNGZf-4x6BCbS6zfSGHyLrVxyolvnBp_IlLNvpDDZH88QPBMXdmbIQKVb9rvvLCUETUR1AzjT00t6inaqE-KQaJt8SOUj6Nw9Lr10gPcDE5iCUzleNYVZ_lWq0gCjAF0eVZ3EumDQSCSKM3vqd8VxjiVqYmek1RFFF6F7ECjriKOlrrlG1hoUNxAEB6t-S9y2YRAFNaJPRnJU9tnZC6H0A27XjNfNN0d4qwPedUiC6K7QR4mHY5YM80V6TULEOOo5MG6ux0SU5zi5YN3OCNvo3ECsBNpfxHj-oOJsUPQ8LNfM0CcJ_XGuceA', '{\n  \"success\": true,\n  \"challenge_ts\": \"2024-04-17T11:32:20Z\",\n  \"hostname\": \"Chargebackbase.com\"\n}', '2024-04-17 11:33:14');

-- --------------------------------------------------------

--
-- Table structure for table `casemessages`
--

CREATE TABLE `casemessages` (
  `id` int(10) UNSIGNED NOT NULL,
  `caseref` varchar(250) NOT NULL,
  `reference` varchar(250) NOT NULL,
  `userid` varchar(250) NOT NULL,
  `message` text NOT NULL,
  `messagetype` varchar(250) DEFAULT NULL,
  `status` varchar(250) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `casemessages`
--

INSERT INTO `casemessages` (`id`, `caseref`, `reference`, `userid`, `message`, `messagetype`, `status`, `timestamp`, `date`) VALUES
(1, '72116e26-c90b-4bd5-86cb-bfb48d914f19', '566c36db-ceec-4870-b303-c7dcc504ea22', '0', 'Generate QR Codes for free with QR.io. Download in just a few seconds. \r\nAnd keep track of how many people scan your QR Codes, from where and on what date. QR Code with Logo. QR Code for Website URL. Benefits: No...', 'message-out', '0', NULL, '2024-04-16 15:27:23'),
(2, '72116e26-c90b-4bd5-86cb-bfb48d914f19', '511ada86-3dff-4130-822e-3dda755317ca', '0', 'some of the evidences<br>New File Uploaded', 'message-out', '0', NULL, '2024-04-16 15:28:28'),
(3, '72116e26-c90b-4bd5-86cb-bfb48d914f19', 'ca2dc65a-0130-4456-a5c4-a1e56ce0ff78', '1', 'hello', 'message-out', '0', NULL, '2024-04-17 11:22:55');

-- --------------------------------------------------------

--
-- Table structure for table `cases`
--

CREATE TABLE `cases` (
  `id` int(10) UNSIGNED NOT NULL,
  `reference` varchar(250) NOT NULL,
  `userid` varchar(250) NOT NULL,
  `subject` varchar(250) NOT NULL,
  `ccy` varchar(250) NOT NULL,
  `casetype` varchar(250) DEFAULT NULL,
  `amount` varchar(250) DEFAULT NULL,
  `case_details` text DEFAULT NULL,
  `wallets` text DEFAULT NULL,
  `status` varchar(250) DEFAULT NULL,
  `agent` text DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cases`
--

INSERT INTO `cases` (`id`, `reference`, `userid`, `subject`, `ccy`, `casetype`, `amount`, `case_details`, `wallets`, `status`, `agent`, `timestamp`, `date`) VALUES
(1, '72116e26-c90b-4bd5-86cb-bfb48d914f19', '1', 'my first recovery case', 'BITCOIN', 'Crypto', '1', 'Generate QR Codes for free with QR.io. Download in just a few seconds. \r\nAnd keep track of how many people scan your QR Codes, from where and on what date. QR Code with Logo. QR Code for Website URL. Benefits: No...', 'ltc1q8g3vtu0lfa9jmmhcw99ym3c0t2lyztt5p6gnuv', '0', NULL, NULL, '2024-04-16 15:27:23');

-- --------------------------------------------------------

--
-- Table structure for table `deposits`
--

CREATE TABLE `deposits` (
  `id` int(10) UNSIGNED NOT NULL,
  `method` varchar(250) NOT NULL,
  `amount` float DEFAULT NULL,
  `charges` varchar(250) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `confirmations` int(11) DEFAULT NULL,
  `hash` varchar(250) DEFAULT NULL,
  `ccyamount` float DEFAULT NULL,
  `ccyvalue` float DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `deposits`
--

INSERT INTO `deposits` (`id`, `method`, `amount`, `charges`, `userid`, `status`, `confirmations`, `hash`, `ccyamount`, `ccyvalue`, `timestamp`, `date`) VALUES
(1, 'BITCOIN', 100, '0', 1, 0, NULL, NULL, NULL, NULL, NULL, '2024-04-16 15:13:17');

-- --------------------------------------------------------

--
-- Table structure for table `faqheader`
--

CREATE TABLE `faqheader` (
  `ID` int(20) UNSIGNED NOT NULL,
  `text` varchar(320) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqheader`
--

INSERT INTO `faqheader` (`ID`, `text`, `date`, `timestamp`) VALUES
(1, 'Getting Started', '2024-04-17 11:57:38', NULL),
(2, 'Fees', '2024-04-17 12:01:30', NULL),
(3, 'The Recovery Process', '2024-04-17 12:06:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `ID` int(20) UNSIGNED NOT NULL,
  `subjectid` varchar(320) DEFAULT NULL,
  `question` varchar(320) DEFAULT NULL,
  `answer` varchar(8000) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`ID`, `subjectid`, `question`, `answer`, `date`, `timestamp`) VALUES
(1, '1', 'How do I begin the recovery process with Chargebackbase.com?', 'To initiate the recovery process, simply get an account with your email and create a case using our online form with details about your case. Our team will review the information provided and determine if we can assist you. If your case meets our criteria, we\'ll assign an agent to guide you through the next steps.', '2024-04-17 11:59:07', NULL),
(2, '1', 'What information do I need to provide when submitting my case?', 'When submitting your case, it\'s essential to provide as much relevant information as possible. This includes details such as transaction history, account information, communication records with involved parties, and any documentation related to the incident. The more information we have, the better equipped we\'ll be to assess your case and provide assistance.', NULL, NULL),
(3, '1', 'How long does it take for Chargebackbase.com to review my case and assign an agent?', 'Typically, our team reviews submitted cases within 24 to 48 hours. If we determine that we can assist you, an agent will be assigned to your case promptly. From there, the agent will reach out to you to discuss the specifics of your situation and guide you through the recovery process. Please note that response times may vary depending on case volume and complexity, but we strive to provide timely assistance to all our clients.', '2024-04-17 12:00:48', NULL),
(4, '2', 'Is there a fee for submitting my case to Chargebackbase.com?', 'No, there is no fee for submitting your case for review. Our initial assessment of your case is completely free of charge. If we determine that we can assist you and you decide to proceed with our services, we\'ll discuss our fee structure with you transparently before moving forward.', '2024-04-17 12:03:18', NULL),
(5, '1', 'What types of cases does Chargebackbase.com specialize in?', 'Chargebackbase.com specializes in cryptocurrency recovery and financial chargeback services. We handle a wide range of cases, including but not limited to lost or stolen cryptocurrency, fraudulent transactions, unauthorized charges, and payment disputes with merchants or service providers.', '2024-04-17 12:03:18', NULL),
(6, '1', 'Is my personal information safe and secure with Chargebackbase.com?', 'Absolutely. At Chargebackbase.com, we take data privacy and security seriously. We adhere to strict confidentiality protocols to ensure that your personal information is safeguarded at all times. Rest assured that any information you provide to us is treated with the utmost confidentiality and will only be used for the purpose of assisting you with your case.', NULL, NULL),
(7, '2', 'Are my fees refundable?', 'Yes, Chargebackbase.com offers a refund policy under certain circumstances. If, for any reason, we are unable to assist you with your case or if our efforts do not result in a successful recovery, we may offer a partial or full refund of any fees paid, depending on the specific circumstances of your case. Our team will discuss the refund policy with you transparently before you decide to proceed with our services. Rest assured, we are committed to ensuring fairness and satisfaction for all our clients.', '2024-04-17 12:04:55', NULL),
(8, '3', 'How long does the recovery process typically take with Chargebackbase.com?', 'The duration of the recovery process can vary depending on various factors, including the complexity of your case, the cooperation of involved parties, and the specific circumstances surrounding the incident. While some cases may be resolved relatively quickly, others may require more time and effort. Our team will provide you with an estimated timeline based on the specifics of your case.', '2024-04-17 12:07:17', NULL),
(9, '3', 'What communication can I expect from Chargebackbase.com throughout the process?', 'At Chargebackbase.com, we believe in keeping our clients informed every step of the way. Your assigned agent will provide regular updates on the progress of your case and will be available to address any questions or concerns you may have. We strive to maintain open and transparent communication to ensure that you are always kept in the loop.', '2024-04-17 12:07:17', NULL),
(10, '3', 'What happens if my case is outside of Chargebackbase.com\'s jurisdiction or capabilities?', 'If your case falls outside of our jurisdiction or capabilities, we will inform you promptly and provide guidance on alternative options or resources that may be able to assist you. While we make every effort to assist as many clients as possible, there may be certain limitations or constraints that prevent us from taking on certain cases. Rest assured, we will do our best to provide you with helpful information and support.', '2024-04-17 12:08:08', NULL),
(11, '3', 'What if I don\'t have all the necessary documentation for my case?', 'While having comprehensive documentation can strengthen your case, we understand that gathering all necessary information may not always be possible. If you\'re missing certain documents or details, don\'t worry. Our team will work with you to gather as much relevant information as possible and explore alternative strategies for recovery.', '2024-04-17 12:09:10', NULL),
(12, '3', 'Can I track the progress of my case online?', 'Yes, Chargebackbase.com provides clients with access to a secure online portal where you can track the progress of your case in real-time. Simply log in to your account to view updates, communicate with your assigned agent, and access important documents related to your case. Our user-friendly interface makes it easy to stay informed throughout the recovery process.', '2024-04-17 12:10:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE `newsletter` (
  `ID` int(20) UNSIGNED NOT NULL,
  `email` varchar(320) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pagevisit`
--

CREATE TABLE `pagevisit` (
  `ID` int(20) UNSIGNED NOT NULL,
  `email` varchar(320) DEFAULT NULL,
  `browser` varchar(320) DEFAULT NULL,
  `mobile` varchar(320) DEFAULT NULL,
  `actiondone` varchar(320) DEFAULT NULL,
  `req` text DEFAULT NULL,
  `res` text DEFAULT NULL,
  `day` date DEFAULT curdate(),
  `date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pagevisit`
--

INSERT INTO `pagevisit` (`ID`, `email`, `browser`, `mobile`, `actiondone`, `req`, `res`, `day`, `date`) VALUES
(1, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'login', '', '', '2024-04-16', '2024-04-16 15:06:48'),
(2, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'login', '', '', '2024-04-16', '2024-04-16 15:08:01'),
(3, '95.164.232.55', 'Firefox', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-16', '2024-04-16 15:08:07'),
(4, '54.86.136.76', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-16', '2024-04-16 15:08:09'),
(5, '66.249.74.128', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-16', '2024-04-16 15:08:12'),
(6, '66.249.74.130', 'UnKnown', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-16', '2024-04-16 15:08:12'),
(7, '209.127.97.246', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-16', '2024-04-16 15:08:45'),
(8, '205.169.39.148', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-16', '2024-04-16 15:09:02'),
(9, '205.169.39.148', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-16', '2024-04-16 15:09:10'),
(10, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'login', '', '', '2024-04-16', '2024-04-16 15:09:10'),
(11, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account', '', '', '2024-04-16', '2024-04-16 15:09:16'),
(12, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account?n=edit', '', '', '2024-04-16', '2024-04-16 15:09:22'),
(13, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account?n=deposit-new', '', '', '2024-04-16', '2024-04-16 15:09:26'),
(14, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account?n=deposit-new', '', '', '2024-04-16', '2024-04-16 15:12:58'),
(15, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account?n=deposit-new&hash=f899139df5e1059396431415e770c6dd', '', '', '2024-04-16', '2024-04-16 15:13:18'),
(16, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account?n=deposit-new&hash=f899139df5e1059396431415e770c6dd', '', '', '2024-04-16', '2024-04-16 15:17:25'),
(17, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account?n=deposit-new&hash=f899139df5e1059396431415e770c6dd', '', '', '2024-04-16', '2024-04-16 15:18:06'),
(18, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'UnKnown', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account?n=', '', '', '2024-04-16', '2024-04-16 15:18:43'),
(19, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account?n=', '', '', '2024-04-16', '2024-04-16 15:19:07'),
(20, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account?n=cases-all', '', '', '2024-04-16', '2024-04-16 15:19:09'),
(21, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account?n=', '', '', '2024-04-16', '2024-04-16 15:19:10'),
(22, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account?n=deposit-new', '', '', '2024-04-16', '2024-04-16 15:19:13'),
(23, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'UnKnown', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account?n=deposit-new', '', '', '2024-04-16', '2024-04-16 15:22:48'),
(24, '192.87.174.28', 'UnKnown', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-16', '2024-04-16 15:22:54'),
(25, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'UnKnown', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account?n=deposit-new', '', '', '2024-04-16', '2024-04-16 15:25:04'),
(26, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'UnKnown', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account?n=deposit-new', '', '', '2024-04-16', '2024-04-16 15:25:06'),
(27, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'UnKnown', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account?n=deposit-new', '', '', '2024-04-16', '2024-04-16 15:25:24'),
(28, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account?n=cases-all', '', '', '2024-04-16', '2024-04-16 15:25:37'),
(29, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account?n=cases-new', '', '', '2024-04-16', '2024-04-16 15:25:39'),
(30, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account?n=cases-new', '', '', '2024-04-16', '2024-04-16 15:26:14'),
(31, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account?n=cases-all&ref=72116e26-c90b-4bd5-86cb-bfb48d914f19', '', '', '2024-04-16', '2024-04-16 15:27:24'),
(32, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account?n=cases-all&ref=72116e26-c90b-4bd5-86cb-bfb48d914f19', '', '', '2024-04-16', '2024-04-16 15:28:15'),
(33, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account?n=cases-all&ref=72116e26-c90b-4bd5-86cb-bfb48d914f19', '', '', '2024-04-16', '2024-04-16 15:28:28'),
(34, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account?n=cases-new', '', '', '2024-04-16', '2024-04-16 15:28:53'),
(35, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account?n=', '', '', '2024-04-16', '2024-04-16 15:28:55'),
(36, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account?n=cases-all&ref=72116e26-c90b-4bd5-86cb-bfb48d914f19', '', '', '2024-04-16', '2024-04-16 15:29:01'),
(37, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account?n=cases-all&ref=72116e26-c90b-4bd5-86cb-bfb48d914f19', '', '', '2024-04-16', '2024-04-16 15:49:59'),
(38, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account?n=cases-all&ref=72116e26-c90b-4bd5-86cb-bfb48d914f19', '', '', '2024-04-16', '2024-04-16 15:50:20'),
(39, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account?n=cases-all&ref=72116e26-c90b-4bd5-86cb-bfb48d914f19', '', '', '2024-04-16', '2024-04-16 15:52:58'),
(40, '192.87.174.28', 'UnKnown', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-16', '2024-04-16 15:53:02'),
(41, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account?n=cases-all&ref=72116e26-c90b-4bd5-86cb-bfb48d914f19', '', '', '2024-04-16', '2024-04-16 16:05:09'),
(42, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account?n=cases-all&ref=72116e26-c90b-4bd5-86cb-bfb48d914f19', '', '', '2024-04-16', '2024-04-16 16:06:13'),
(43, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account?n=cases-all&ref=72116e26-c90b-4bd5-86cb-bfb48d914f19', '', '', '2024-04-16', '2024-04-16 16:07:47'),
(44, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account?n=cases-all&ref=72116e26-c90b-4bd5-86cb-bfb48d914f19', '', '', '2024-04-16', '2024-04-16 16:09:44'),
(45, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account?n=cases-all&ref=72116e26-c90b-4bd5-86cb-bfb48d914f19', '', '', '2024-04-16', '2024-04-16 16:12:06'),
(46, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account?n=cases-all&ref=72116e26-c90b-4bd5-86cb-bfb48d914f19', '', '', '2024-04-16', '2024-04-16 16:12:44'),
(47, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account?n=cases-all&ref=72116e26-c90b-4bd5-86cb-bfb48d914f19', '', '', '2024-04-16', '2024-04-16 16:12:50'),
(48, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account?n=', '', '', '2024-04-16', '2024-04-16 16:12:53'),
(49, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account?n=', '', '', '2024-04-16', '2024-04-16 16:13:08'),
(50, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'logout', '', '', '2024-04-16', '2024-04-16 16:13:12'),
(51, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'index', '', '', '2024-04-16', '2024-04-16 16:13:12'),
(52, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'login', '', '', '2024-04-16', '2024-04-16 16:13:14'),
(53, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'login', '', '', '2024-04-16', '2024-04-16 16:13:19'),
(54, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account', '', '', '2024-04-16', '2024-04-16 16:14:02'),
(55, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'admin?n=members', '', '', '2024-04-16', '2024-04-16 16:14:05'),
(56, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'admin?n=members', '', '', '2024-04-16', '2024-04-16 16:14:10'),
(57, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'admin', '', '', '2024-04-16', '2024-04-16 16:14:11'),
(58, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'admin?n=cases', '', '', '2024-04-16', '2024-04-16 16:14:14'),
(59, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'admin?n=cases&ref=72116e26-c90b-4bd5-86cb-bfb48d914f19', '', '', '2024-04-16', '2024-04-16 16:14:16'),
(60, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'admin?n=cases', '', '', '2024-04-16', '2024-04-16 16:14:19'),
(61, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account?n=cases-all', '', '', '2024-04-16', '2024-04-16 16:14:51'),
(62, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'admin?n=cases', '', '', '2024-04-16', '2024-04-16 16:14:55'),
(63, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'admin?n=cases', '', '', '2024-04-16', '2024-04-16 16:16:59'),
(64, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'admin?n=cases', '', '', '2024-04-16', '2024-04-16 16:17:46'),
(65, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'admin?n=cases', '', '', '2024-04-16', '2024-04-16 16:20:03'),
(66, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'admin?n=cases&ref=72116e26-c90b-4bd5-86cb-bfb48d914f19', '', '', '2024-04-16', '2024-04-16 16:20:33'),
(67, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'admin?n=cases&ref=72116e26-c90b-4bd5-86cb-bfb48d914f19', '', '', '2024-04-16', '2024-04-16 16:20:45'),
(68, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account?n=cases-all', '', '', '2024-04-16', '2024-04-16 16:21:52'),
(69, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account?n=cases-all', '', '', '2024-04-16', '2024-04-16 16:23:13'),
(70, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account?n=cases-all', '', '', '2024-04-16', '2024-04-16 16:23:42'),
(71, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account?n=cases-all', '', '', '2024-04-16', '2024-04-16 16:23:47'),
(72, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account?n=cases-all', '', '', '2024-04-16', '2024-04-16 16:25:27'),
(73, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account?n=cases-all', '', '', '2024-04-16', '2024-04-16 16:26:24'),
(74, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account?n=cases-all&del=1', '', '', '2024-04-16', '2024-04-16 16:26:33'),
(75, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account?n=cases-all', '', '', '2024-04-16', '2024-04-16 16:27:28'),
(76, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account?n=cases-all', '', '', '2024-04-16', '2024-04-16 16:28:27'),
(77, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'admin?n=cases', '', '', '2024-04-16', '2024-04-16 16:28:33'),
(78, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'admin?n=cases&ref=72116e26-c90b-4bd5-86cb-bfb48d914f19', '', '', '2024-04-16', '2024-04-16 16:28:36'),
(79, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'admin?n=cases&ref=72116e26-c90b-4bd5-86cb-bfb48d914f19', '', '', '2024-04-16', '2024-04-16 16:29:31'),
(80, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'admin?n=cases&del=1', '', '', '2024-04-16', '2024-04-16 16:29:37'),
(81, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'admin?n=cases', '', '', '2024-04-16', '2024-04-16 16:29:38'),
(82, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'admin?n=deposits', '', '', '2024-04-16', '2024-04-16 16:31:00'),
(83, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'admin?n=deposits', '', '', '2024-04-16', '2024-04-16 16:32:06'),
(84, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'admin?n=deposits', '', '', '2024-04-16', '2024-04-16 16:33:26'),
(85, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'admin?n=withdrawals', '', '', '2024-04-16', '2024-04-16 16:33:36'),
(86, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'admin?n=deposits', '', '', '2024-04-16', '2024-04-16 16:33:39'),
(87, '89.149.39.8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'index', '', '', '2024-04-16', '2024-04-16 16:37:45'),
(88, '89.149.39.8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'index', '', '', '2024-04-16', '2024-04-16 16:38:07'),
(89, '89.149.39.8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-16', '2024-04-16 16:38:22'),
(90, '52.16.245.145', 'Firefox', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-16', '2024-04-16 16:41:18'),
(91, '52.16.245.145', 'Firefox', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-16', '2024-04-16 16:41:19'),
(92, '52.16.245.145', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-16', '2024-04-16 16:41:23'),
(93, '52.16.245.145', 'Firefox', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-16', '2024-04-16 16:41:37'),
(94, '52.16.245.145', 'Firefox', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-16', '2024-04-16 16:41:38'),
(95, '52.16.245.145', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-16', '2024-04-16 16:41:40'),
(96, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account?n=edit', '', '', '2024-04-16', '2024-04-16 16:42:33'),
(97, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'logout', '', '', '2024-04-16', '2024-04-16 16:43:22'),
(98, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'index', '', '', '2024-04-16', '2024-04-16 16:43:23'),
(99, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'login', '', '', '2024-04-16', '2024-04-16 16:43:26'),
(100, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'login', '', '', '2024-04-16', '2024-04-16 16:45:09'),
(101, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'login', '', '', '2024-04-16', '2024-04-16 16:47:16'),
(102, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'login', '', '', '2024-04-16', '2024-04-16 16:48:14'),
(103, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-16', '2024-04-16 16:48:27'),
(104, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-16', '2024-04-16 16:48:34'),
(105, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'index', '', '', '2024-04-16', '2024-04-16 16:48:37'),
(106, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'login', '', '', '2024-04-16', '2024-04-16 16:48:39'),
(107, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-16', '2024-04-16 16:57:37'),
(108, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'login', '', '', '2024-04-16', '2024-04-16 16:57:47'),
(109, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-16', '2024-04-16 16:57:54'),
(110, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-16', '2024-04-16 16:58:51'),
(111, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-16', '2024-04-16 16:59:11'),
(112, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-16', '2024-04-16 17:02:49'),
(113, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'privacy', '', '', '2024-04-16', '2024-04-16 17:02:56'),
(114, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'index', '', '', '2024-04-16', '2024-04-16 17:03:09'),
(115, '162.222.198.183', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-16', '2024-04-16 17:03:32'),
(116, '161.35.246.138', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-16', '2024-04-16 17:03:39'),
(117, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'login', '', '', '2024-04-16', '2024-04-16 17:03:51'),
(118, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'index', '', '', '2024-04-16', '2024-04-16 17:03:54'),
(119, '74.125.217.129', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'index', '', '', '2024-04-16', '2024-04-16 17:03:55'),
(120, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'login', '', '', '2024-04-16', '2024-04-16 17:03:55'),
(121, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'index', '', '', '2024-04-16', '2024-04-16 17:04:02'),
(122, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'index', '', '', '2024-04-16', '2024-04-16 17:04:30'),
(123, '74.125.217.129', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'index', '', '', '2024-04-16', '2024-04-16 17:04:31'),
(124, '2c0f:2a80:b0:bf10:b42d:f5:446b:a9e8', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'login', '', '', '2024-04-16', '2024-04-16 17:04:42'),
(125, '135.148.100.196', 'UnKnown', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-16', '2024-04-16 17:34:17'),
(126, '102.88.82.112', 'UnKnown', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-16', '2024-04-16 17:44:51'),
(127, '192.87.174.28', 'UnKnown', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-16', '2024-04-16 17:52:58'),
(128, '2a00:6800:3:b9f::1', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-16', '2024-04-16 19:44:21'),
(129, '192.87.174.28', 'UnKnown', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-16', '2024-04-16 20:53:05'),
(130, '191.102.170.55', 'UnKnown', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 00:16:07'),
(131, '191.102.163.245', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 00:16:13'),
(132, '95.164.159.49', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 00:16:14'),
(133, '156.246.13.147', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 01:38:10'),
(134, '192.87.174.28', 'UnKnown', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 02:52:54'),
(135, '171.244.43.14', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 02:57:37'),
(136, '193.122.155.11', 'UnKnown', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 04:30:43'),
(137, '34.219.84.228', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 04:40:42'),
(138, '35.94.117.104', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 04:41:30'),
(139, '149.56.15.153', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 04:55:33'),
(140, '149.56.15.153', 'UnKnown', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 04:55:41'),
(141, '149.56.15.153', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 04:56:04'),
(142, '149.56.15.153', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 04:56:04'),
(143, '149.56.15.153', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'index', '', '', '2024-04-17', '2024-04-17 04:56:07'),
(144, '149.56.15.153', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'index', '', '', '2024-04-17', '2024-04-17 04:56:08'),
(145, '149.56.15.153', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'login', '', '', '2024-04-17', '2024-04-17 04:56:08'),
(146, '149.56.15.153', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'login', '', '', '2024-04-17', '2024-04-17 04:56:08'),
(147, '149.56.15.153', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'about', '', '', '2024-04-17', '2024-04-17 04:56:09'),
(148, '149.56.15.153', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'about', '', '', '2024-04-17', '2024-04-17 04:56:09'),
(149, '149.56.15.153', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'faq', '', '', '2024-04-17', '2024-04-17 04:56:09'),
(150, '149.56.15.153', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'faq', '', '', '2024-04-17', '2024-04-17 04:56:10'),
(151, '149.56.15.153', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'contact', '', '', '2024-04-17', '2024-04-17 04:56:10'),
(152, '149.56.15.153', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'contact', '', '', '2024-04-17', '2024-04-17 04:56:10'),
(153, '149.56.15.153', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'privacy', '', '', '2024-04-17', '2024-04-17 04:56:10'),
(154, '149.56.15.153', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'privacy', '', '', '2024-04-17', '2024-04-17 04:56:10'),
(155, '149.56.15.153', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'terms', '', '', '2024-04-17', '2024-04-17 04:56:10'),
(156, '149.56.15.153', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'terms', '', '', '2024-04-17', '2024-04-17 04:56:10'),
(157, '149.56.15.153', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'aml', '', '', '2024-04-17', '2024-04-17 04:56:10'),
(158, '149.56.15.153', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'aml', '', '', '2024-04-17', '2024-04-17 04:56:10'),
(159, '149.56.15.153', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 04:56:32'),
(160, '149.56.15.153', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 04:56:43'),
(161, '149.56.15.153', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'index', '', '', '2024-04-17', '2024-04-17 04:57:42'),
(162, '149.56.15.153', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'index', '', '', '2024-04-17', '2024-04-17 04:57:49'),
(163, '149.56.15.153', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'login', '', '', '2024-04-17', '2024-04-17 04:57:52'),
(164, '149.56.15.153', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'login', '', '', '2024-04-17', '2024-04-17 04:57:52'),
(165, '107.178.194.99', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 05:05:32'),
(166, '100.26.102.60', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 05:05:32'),
(167, '18.117.134.59', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 05:05:32'),
(168, '3.23.99.30', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 05:05:32'),
(169, '107.178.194.99', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 05:05:32'),
(170, '34.86.212.119', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 05:05:33'),
(171, '35.243.23.68', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 05:05:34'),
(172, '100.26.102.60', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 05:05:34'),
(173, '3.14.142.176', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 05:05:34'),
(174, '13.59.220.187', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 05:05:34'),
(175, '35.243.23.70', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 05:05:34'),
(176, '66.249.74.128', 'UnKnown', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 05:05:35'),
(177, '66.249.74.130', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 05:05:36'),
(178, '107.178.194.98', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 05:05:42'),
(179, '107.178.194.97', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 05:05:43'),
(180, '66.249.64.13', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 05:05:43'),
(181, '35.243.23.69', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 05:05:44'),
(182, '35.243.23.69', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 05:05:44'),
(183, '66.249.64.14', 'UnKnown', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 05:05:44'),
(184, '149.56.15.153', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'about', '', '', '2024-04-17', '2024-04-17 05:10:07'),
(185, '149.56.15.153', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'about', '', '', '2024-04-17', '2024-04-17 05:10:10'),
(186, '149.56.15.153', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'faq', '', '', '2024-04-17', '2024-04-17 05:10:25'),
(187, '149.56.15.153', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'faq', '', '', '2024-04-17', '2024-04-17 05:10:59'),
(188, '149.56.15.153', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'contact', '', '', '2024-04-17', '2024-04-17 05:11:02'),
(189, '149.56.15.153', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'contact', '', '', '2024-04-17', '2024-04-17 05:11:19'),
(190, '149.56.15.153', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'privacy', '', '', '2024-04-17', '2024-04-17 05:12:08'),
(191, '91.196.223.217', 'UnKnown', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 05:15:06'),
(192, '91.196.223.217', 'UnKnown', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'login', '', '', '2024-04-17', '2024-04-17 05:15:51'),
(193, '91.196.223.217', 'UnKnown', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'login', '', '', '2024-04-17', '2024-04-17 05:16:27'),
(194, '93.159.230.90', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 05:17:16'),
(195, '93.159.230.87', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 05:17:30'),
(196, '18.216.73.103', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 05:56:33'),
(197, '180.149.10.78', 'UnKnown', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 06:00:47'),
(198, '168.151.246.54', 'UnKnown', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 06:02:45'),
(199, '196.196.35.89', 'Firefox', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 06:06:38'),
(200, '196.242.70.25', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 06:06:38'),
(201, '176.125.228.22', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 06:11:34'),
(202, '104.165.199.117', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 06:12:36'),
(203, '104.165.199.190', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 06:12:36'),
(204, '64.57.140.131', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 06:12:42'),
(205, '38.100.114.78', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 06:12:42'),
(206, '196.196.53.89', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 06:12:51'),
(207, '99.185.5.141', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 06:13:22'),
(208, '24.179.213.118', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 06:13:23'),
(209, '192.36.109.82', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 06:21:28'),
(210, '65.154.226.168', 'UnKnown', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 06:25:57'),
(211, '65.154.226.170', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 06:25:57');
INSERT INTO `pagevisit` (`ID`, `email`, `browser`, `mobile`, `actiondone`, `req`, `res`, `day`, `date`) VALUES
(212, '66.249.64.12', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 06:52:50'),
(213, '104.251.123.53', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'login', '', '', '2024-04-17', '2024-04-17 07:41:11'),
(214, '205.169.39.120', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 08:15:40'),
(215, '205.169.39.120', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 08:15:50'),
(216, '66.249.64.14', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'index', '', '', '2024-04-17', '2024-04-17 09:26:52'),
(217, '66.249.64.12', 'UnKnown', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'index', '', '', '2024-04-17', '2024-04-17 09:27:04'),
(218, '66.249.64.13', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'index', '', '', '2024-04-17', '2024-04-17 09:27:04'),
(219, '149.88.26.140', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 09:36:13'),
(220, '149.88.26.140', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 09:36:19'),
(221, '149.88.26.140', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'login', '', '', '2024-04-17', '2024-04-17 09:36:36'),
(222, '149.88.26.140', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'login', '', '', '2024-04-17', '2024-04-17 09:36:43'),
(223, '104.251.123.53', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'login', '', '', '2024-04-17', '2024-04-17 09:46:31'),
(224, '149.88.26.161', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'login', '', '', '2024-04-17', '2024-04-17 09:48:14'),
(225, '149.88.26.161', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'login', '', '', '2024-04-17', '2024-04-17 09:48:42'),
(226, '149.88.26.161', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account', '', '', '2024-04-17', '2024-04-17 09:48:49'),
(227, '149.88.26.161', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'logout', '', '', '2024-04-17', '2024-04-17 09:49:07'),
(228, '149.88.26.161', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'index', '', '', '2024-04-17', '2024-04-17 09:49:07'),
(229, '149.88.26.161', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'index', '', '', '2024-04-17', '2024-04-17 09:59:25'),
(230, '149.88.26.161', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'index', '', '', '2024-04-17', '2024-04-17 10:00:36'),
(231, '149.88.26.161', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'index', '', '', '2024-04-17', '2024-04-17 10:05:23'),
(232, '149.88.26.161', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'index', '', '', '2024-04-17', '2024-04-17 10:13:37'),
(233, '149.88.26.161', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'index', '', '', '2024-04-17', '2024-04-17 10:14:15'),
(234, '135.148.195.3', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 10:28:29'),
(235, '149.88.26.160', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'index', '', '', '2024-04-17', '2024-04-17 10:32:08'),
(236, '149.88.26.160', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'index', '', '', '2024-04-17', '2024-04-17 10:33:37'),
(237, '149.88.26.160', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'index', '', '', '2024-04-17', '2024-04-17 10:35:18'),
(238, '149.88.26.160', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'index', '', '', '2024-04-17', '2024-04-17 10:42:20'),
(239, '149.88.26.160', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'index', '', '', '2024-04-17', '2024-04-17 10:45:52'),
(240, '149.88.26.160', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'index', '', '', '2024-04-17', '2024-04-17 10:47:34'),
(241, '149.88.26.160', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'index', '', '', '2024-04-17', '2024-04-17 10:48:31'),
(242, '149.88.26.160', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'about', '', '', '2024-04-17', '2024-04-17 10:51:10'),
(243, '149.88.26.160', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'about', '', '', '2024-04-17', '2024-04-17 10:52:52'),
(244, '149.88.26.160', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'about', '', '', '2024-04-17', '2024-04-17 10:53:08'),
(245, '149.88.26.160', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'faq', '', '', '2024-04-17', '2024-04-17 10:55:11'),
(246, '149.88.26.160', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'login', '', '', '2024-04-17', '2024-04-17 10:55:45'),
(247, '149.88.26.160', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'login', '', '', '2024-04-17', '2024-04-17 10:56:19'),
(248, '149.88.26.160', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'index', '', '', '2024-04-17', '2024-04-17 10:58:10'),
(249, '149.88.26.160', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'faq', '', '', '2024-04-17', '2024-04-17 10:58:15'),
(250, '149.88.26.160', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'faq', '', '', '2024-04-17', '2024-04-17 11:00:26'),
(251, '149.88.26.160', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'faq', '', '', '2024-04-17', '2024-04-17 11:01:09'),
(252, '149.88.26.160', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'faq', '', '', '2024-04-17', '2024-04-17 11:04:30'),
(253, '149.88.26.160', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'faq', '', '', '2024-04-17', '2024-04-17 11:05:53'),
(254, '149.88.26.160', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'faq', '', '', '2024-04-17', '2024-04-17 11:08:36'),
(255, '149.88.26.160', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'faq', '', '', '2024-04-17', '2024-04-17 11:09:41'),
(256, '149.88.26.160', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'faq', '', '', '2024-04-17', '2024-04-17 11:10:24'),
(257, '17.241.75.98', 'UnKnown', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 11:13:20'),
(258, '17.241.75.14', 'UnKnown', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 11:13:54'),
(259, '176.53.223.22', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 11:17:16'),
(260, '2a09:bac2:4d38:ed2::17a:57', 'UnKnown', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 11:20:19'),
(261, '2a09:bac2:4d38:ed2::17a:57', 'UnKnown', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'about', '', '', '2024-04-17', '2024-04-17 11:20:59'),
(262, '2a09:bac2:4d38:ed2::17a:57', 'UnKnown', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'faq', '', '', '2024-04-17', '2024-04-17 11:21:06'),
(263, '2a09:bac2:4d38:ed2::17a:57', 'UnKnown', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'login', '', '', '2024-04-17', '2024-04-17 11:21:17'),
(264, '2a09:bac2:4d38:ed2::17a:57', 'UnKnown', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'login', '', '', '2024-04-17', '2024-04-17 11:21:49'),
(265, '2a09:bac2:4d38:ed2::17a:57', 'UnKnown', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account', '', '', '2024-04-17', '2024-04-17 11:21:57'),
(266, '2a09:bac2:4d38:ed2::17a:57', 'UnKnown', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account?n=cases-all', '', '', '2024-04-17', '2024-04-17 11:22:14'),
(267, '2a09:bac2:4d38:ed2::17a:57', 'UnKnown', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account?n=cases-all&ref=72116e26-c90b-4bd5-86cb-bfb48d914f19', '', '', '2024-04-17', '2024-04-17 11:22:21'),
(268, '2a09:bac2:4d38:ed2::17a:57', 'UnKnown', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account?n=cases-all&ref=72116e26-c90b-4bd5-86cb-bfb48d914f19', '', '', '2024-04-17', '2024-04-17 11:22:56'),
(269, '2a09:bac2:4d38:ed2::17a:57', 'UnKnown', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'admin?n=members', '', '', '2024-04-17', '2024-04-17 11:23:44'),
(270, '2a09:bac2:4d38:ed2::17a:57', 'UnKnown', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account?n=deposit-new', '', '', '2024-04-17', '2024-04-17 11:23:50'),
(271, '2a09:bac2:4d38:ed2::17a:57', 'UnKnown', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account?n=withdraw-new', '', '', '2024-04-17', '2024-04-17 11:24:01'),
(272, '2a09:bac2:4d38:ed2::17a:57', 'UnKnown', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account?n=withdraw-address', '', '', '2024-04-17', '2024-04-17 11:24:10'),
(273, '2a09:bac2:4d38:ed2::17a:57', 'UnKnown', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account?n=transaction-log', '', '', '2024-04-17', '2024-04-17 11:24:15'),
(274, '2a09:bac2:4d38:ed2::17a:57', 'UnKnown', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account?n=deposit-history', '', '', '2024-04-17', '2024-04-17 11:24:42'),
(275, '2a09:bac2:4d38:ed2::17a:57', 'UnKnown', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account?n=', '', '', '2024-04-17', '2024-04-17 11:24:46'),
(276, '2a09:bac2:4d38:ed2::17a:57', 'UnKnown', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'logout', '', '', '2024-04-17', '2024-04-17 11:24:55'),
(277, '2a09:bac2:4d38:ed2::17a:57', 'UnKnown', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'index', '', '', '2024-04-17', '2024-04-17 11:24:55'),
(278, '89.41.26.57', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 11:25:02'),
(279, '89.41.26.57', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 11:25:03'),
(280, '89.41.26.57', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 11:25:06'),
(281, '34.247.87.13', 'UnKnown', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 11:25:14'),
(282, '54.78.140.246', 'UnKnown', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 11:25:23'),
(283, '18.201.229.194', 'UnKnown', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 11:25:24'),
(284, '89.41.26.57', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'index', '', '', '2024-04-17', '2024-04-17 11:26:03'),
(285, '2c0f:2a80:16:5310:8151:b03f:65ac:3efa', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 11:29:04'),
(286, '3.255.172.4', 'UnKnown', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 11:30:34'),
(287, '89.41.26.57', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'login', '', '', '2024-04-17', '2024-04-17 11:32:15'),
(288, '89.41.26.57', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'login', '', '', '2024-04-17', '2024-04-17 11:33:15'),
(289, '89.41.26.57', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account', '', '', '2024-04-17', '2024-04-17 11:33:43'),
(290, '54.220.82.239', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 11:33:43'),
(291, '107.20.61.151', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 11:33:44'),
(292, '89.41.26.57', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account?n=cases-new', '', '', '2024-04-17', '2024-04-17 11:34:03'),
(293, '107.20.61.151', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'index', '', '', '2024-04-17', '2024-04-17 11:34:03'),
(294, '107.20.61.151', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'terms', '', '', '2024-04-17', '2024-04-17 11:34:08'),
(295, '107.20.61.151', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'login', '', '', '2024-04-17', '2024-04-17 11:34:15'),
(296, '107.20.61.151', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'contact', '', '', '2024-04-17', '2024-04-17 11:34:18'),
(297, '89.41.26.57', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account?n=cases-all', '', '', '2024-04-17', '2024-04-17 11:34:20'),
(298, '89.41.26.57', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account?n=', '', '', '2024-04-17', '2024-04-17 11:34:21'),
(299, '89.41.26.57', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account?n=edit', '', '', '2024-04-17', '2024-04-17 11:34:29'),
(300, '89.41.26.57', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'account?n=', '', '', '2024-04-17', '2024-04-17 11:34:43'),
(301, '107.20.61.151', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'privacy', '', '', '2024-04-17', '2024-04-17 11:34:55'),
(302, '107.20.61.151', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'faq', '', '', '2024-04-17', '2024-04-17 11:35:01'),
(303, '104.251.123.53', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 11:36:53'),
(304, '52.30.28.69', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 11:37:09'),
(305, '44.211.35.89', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 11:37:10'),
(306, '44.211.35.89', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'index', '', '', '2024-04-17', '2024-04-17 11:37:27'),
(307, '44.211.35.89', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'terms', '', '', '2024-04-17', '2024-04-17 11:37:36'),
(308, '44.211.35.89', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'login', '', '', '2024-04-17', '2024-04-17 11:37:37'),
(309, '44.211.35.89', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'contact', '', '', '2024-04-17', '2024-04-17 11:37:39'),
(310, '44.211.35.89', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'privacy', '', '', '2024-04-17', '2024-04-17 11:38:21'),
(311, '44.211.35.89', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'faq', '', '', '2024-04-17', '2024-04-17 11:38:28'),
(312, '54.160.176.76', 'UnKnown', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 11:42:31'),
(313, '3.234.237.138', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', '', '', '', '2024-04-17', '2024-04-17 11:42:33'),
(314, '89.41.26.57', 'Google Chrome', 'Linux us-phx-web872.main-hosting.eu 5.14.0-362.24.2.el9_3.x86_64 #1 SMP PREEMPT_DYNAMIC Sat Mar 30 14:11:54 EDT 2024 x86_64', 'index', '', '', '2024-04-17', '2024-04-17 11:50:29');

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `photo_id` int(10) UNSIGNED NOT NULL,
  `photo_name` text NOT NULL,
  `photo_url` text NOT NULL,
  `photo_large_url` text NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `records`
--

CREATE TABLE `records` (
  `id` int(10) UNSIGNED NOT NULL,
  `method` varchar(250) NOT NULL,
  `amount` float DEFAULT NULL,
  `charges` varchar(250) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `deposit_id` int(11) DEFAULT NULL,
  `msg` text DEFAULT NULL,
  `file` varchar(250) NOT NULL,
  `timestamp` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `records`
--

INSERT INTO `records` (`id`, `method`, `amount`, `charges`, `userid`, `deposit_id`, `msg`, `file`, `timestamp`) VALUES
(1, 'BITCOIN', 100, '0', 0, 1, 'here', 'uploads/media/9011713280397.png', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `recordscase`
--

CREATE TABLE `recordscase` (
  `id` int(10) UNSIGNED NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `message_id` int(11) DEFAULT NULL,
  `file` varchar(250) NOT NULL,
  `timestamp` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `recordscase`
--

INSERT INTO `recordscase` (`id`, `userid`, `message_id`, `file`, `timestamp`) VALUES
(1, 0, 2, 'uploads/media/7281713281308.png', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `recoverys`
--

CREATE TABLE `recoverys` (
  `id` int(10) UNSIGNED NOT NULL,
  `plan` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `amount` varchar(250) DEFAULT NULL,
  `rate` varchar(250) DEFAULT '7',
  `status` int(11) DEFAULT 0,
  `disallownew` varchar(20) DEFAULT 'true',
  `timestamp` timestamp NULL DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `redraws`
--

CREATE TABLE `redraws` (
  `id` int(10) UNSIGNED NOT NULL,
  `method` varchar(250) NOT NULL,
  `amount` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `charges` varchar(250) DEFAULT NULL,
  `msg` text DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `token` varchar(250) DEFAULT NULL,
  `tokenstatus` varchar(250) DEFAULT NULL,
  `hash` varchar(250) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `site_info`
--

CREATE TABLE `site_info` (
  `id` int(10) UNSIGNED NOT NULL,
  `site_name` varchar(550) NOT NULL,
  `site_title` varchar(550) NOT NULL,
  `site_desc` text DEFAULT NULL,
  `site_meta` text DEFAULT NULL,
  `btc_address` varchar(550) DEFAULT NULL,
  `eth_address` varchar(550) DEFAULT NULL,
  `level` varchar(250) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_info`
--

INSERT INTO `site_info` (`id`, `site_name`, `site_title`, `site_desc`, `site_meta`, `btc_address`, `eth_address`, `level`, `date`, `timestamp`) VALUES
(1, 'Chargebackbase.com | Your Premier Crypto Recovery Destination', 'Chargebackbase.com | Your Premier Crypto Exchange Destination', 'Chargebackbase.com: Your Trusted Destination for Secure Cryptocurrency Trading. Experience Seamless Transactions and Reliable Support. Join Us Today!', 'Chargebackbase.com | Your Premier Crypto Recovery Destination, 2024, Exchange, Crypto, Trade', NULL, NULL, 'a9e1fe40d7278e4fe3be29692555212a', '2024-04-16 16:14:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `testimony`
--

CREATE TABLE `testimony` (
  `ID` int(20) UNSIGNED NOT NULL,
  `fname` varchar(320) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `testimony` text DEFAULT NULL,
  `url` varchar(220) DEFAULT NULL,
  `publish` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trac_log`
--

CREATE TABLE `trac_log` (
  `id` int(10) UNSIGNED NOT NULL,
  `log_type` varchar(250) NOT NULL,
  `amount` varchar(250) DEFAULT NULL,
  `link` varchar(250) DEFAULT NULL,
  `post_balance` varchar(250) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `log_details` text DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trac_log`
--

INSERT INTO `trac_log` (`id`, `log_type`, `amount`, `link`, `post_balance`, `userid`, `log_details`, `timestamp`, `date`) VALUES
(1, 'Case Update', '0', NULL, '0', 0, 'New Case-72116e26-c90b-4bd5-86cb-bfb48d914f19', NULL, '2024-04-16 15:27:23'),
(2, 'Case Update', '0', NULL, '0', 0, 'You Replied to Case-72116e26-c90b-4bd5-86cb-bfb48d914f19', NULL, '2024-04-16 15:28:28'),
(3, 'Case Update', '0', NULL, '0', 1, 'You Replied to Case-72116e26-c90b-4bd5-86cb-bfb48d914f19', NULL, '2024-04-17 11:22:55');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `ID` int(20) UNSIGNED NOT NULL,
  `email` varchar(320) DEFAULT NULL,
  `actiondone` varchar(320) DEFAULT NULL,
  `simpleid` varchar(320) DEFAULT NULL,
  `floattype` varchar(320) DEFAULT NULL,
  `currencyfrom` varchar(320) DEFAULT NULL,
  `currencyto` varchar(320) DEFAULT NULL,
  `amountfrom` varchar(320) DEFAULT NULL,
  `amountto` varchar(320) DEFAULT NULL,
  `addressfrom` varchar(320) DEFAULT NULL,
  `addressto` varchar(320) DEFAULT NULL,
  `refundaddress` varchar(320) DEFAULT NULL,
  `userextraemail` varchar(320) DEFAULT NULL,
  `simplestatus` varchar(320) DEFAULT NULL,
  `tstatus` varchar(320) DEFAULT NULL,
  `ccyfrom` text DEFAULT NULL,
  `ccyto` text DEFAULT NULL,
  `obj` text DEFAULT NULL,
  `apireq` datetime DEFAULT NULL,
  `apires` datetime DEFAULT NULL,
  `lastupdate` datetime DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp(),
  `reference` varchar(320) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `fname` varchar(1000) DEFAULT NULL,
  `lname` varchar(1000) DEFAULT NULL,
  `gender` varchar(1000) DEFAULT NULL,
  `uname` varchar(1000) DEFAULT NULL,
  `u_level` int(6) DEFAULT NULL,
  `tm` varchar(32) DEFAULT NULL,
  `sub` int(6) DEFAULT NULL,
  `state` varchar(32) DEFAULT NULL,
  `rstate` varchar(32) DEFAULT NULL,
  `active` int(6) DEFAULT 1,
  `block_reason` varchar(2000) DEFAULT NULL,
  `pno` varchar(32) DEFAULT NULL,
  `hash` varchar(32) DEFAULT NULL,
  `pin` varchar(32) DEFAULT NULL,
  `twofa` varchar(20) DEFAULT NULL,
  `wdltwofa` varchar(20) DEFAULT NULL,
  `wdlerror` varchar(20) DEFAULT NULL,
  `ref_id` int(32) DEFAULT NULL,
  `amt` varchar(32) DEFAULT '0',
  `bonus_amt` varchar(920) DEFAULT '0',
  `avail_amt` varchar(920) DEFAULT '0',
  `recov_amt` varchar(920) DEFAULT '0',
  `times` int(11) DEFAULT 0,
  `profile_url` varchar(320) DEFAULT NULL,
  `address` varchar(320) DEFAULT NULL,
  `zip` varchar(320) DEFAULT NULL,
  `pno2` varchar(320) DEFAULT NULL,
  `country` varchar(320) DEFAULT NULL,
  `city` varchar(320) DEFAULT NULL,
  `email` varchar(500) NOT NULL,
  `password` varchar(32) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `reg_date` datetime DEFAULT NULL,
  `idtype` varchar(50) DEFAULT NULL,
  `idfront` varchar(200) DEFAULT NULL,
  `idback` varchar(200) DEFAULT NULL,
  `idstatus` varchar(20) DEFAULT NULL,
  `iddate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `fname`, `lname`, `gender`, `uname`, `u_level`, `tm`, `sub`, `state`, `rstate`, `active`, `block_reason`, `pno`, `hash`, `pin`, `twofa`, `wdltwofa`, `wdlerror`, `ref_id`, `amt`, `bonus_amt`, `avail_amt`, `recov_amt`, `times`, `profile_url`, `address`, `zip`, `pno2`, `country`, `city`, `email`, `password`, `timestamp`, `reg_date`, `idtype`, `idfront`, `idback`, `idstatus`, `iddate`) VALUES
(1, NULL, NULL, NULL, NULL, 1, '2024-04-17 11:19:54', NULL, 'OFF', NULL, 1, NULL, NULL, 'd93591bdf7860e1e4ee2fca799911215', '', NULL, NULL, NULL, NULL, '0', '0', '0', '0', 0, 'assets/images/avatar.png', NULL, NULL, NULL, NULL, NULL, 'support@vivamarketsonline.com', NULL, '2024-04-17 11:24:54', '2024-04-16 15:08:01', NULL, NULL, NULL, NULL, NULL),
(2, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 1, NULL, NULL, 'a600bd172fcabd688500dac58ebda3a0', 'a600bd172fcabd688500dac58ebda3a0', NULL, NULL, NULL, NULL, '0', '0', '0', '0', 0, 'assets/images/avatar.png', NULL, NULL, NULL, NULL, NULL, 'brandonwhite0@tutanota.com', NULL, '2024-04-17 05:16:27', '2024-04-17 05:16:27', NULL, NULL, NULL, NULL, NULL),
(3, NULL, NULL, NULL, NULL, 0, '2024-04-17 11:45:29', NULL, 'ON', NULL, 1, NULL, NULL, '1a32df83ac6be75b6907fe885465b7a9', '', NULL, NULL, NULL, NULL, '0', '0', '0', '0', 0, 'assets/images/avatar.png', NULL, NULL, NULL, NULL, NULL, 'hojay27155@rartg.com', NULL, '2024-04-17 11:50:29', '2024-04-17 11:33:14', NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addrs`
--
ALTER TABLE `addrs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `apireq`
--
ALTER TABLE `apireq`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `casemessages`
--
ALTER TABLE `casemessages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `cases`
--
ALTER TABLE `cases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `deposits`
--
ALTER TABLE `deposits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `faqheader`
--
ALTER TABLE `faqheader`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `pagevisit`
--
ALTER TABLE `pagevisit`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`photo_id`),
  ADD KEY `photo_id` (`photo_id`);

--
-- Indexes for table `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `recordscase`
--
ALTER TABLE `recordscase`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `recoverys`
--
ALTER TABLE `recoverys`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `redraws`
--
ALTER TABLE `redraws`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `site_info`
--
ALTER TABLE `site_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `testimony`
--
ALTER TABLE `testimony`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `trac_log`
--
ALTER TABLE `trac_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addrs`
--
ALTER TABLE `addrs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `agents`
--
ALTER TABLE `agents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `apireq`
--
ALTER TABLE `apireq`
  MODIFY `ID` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `casemessages`
--
ALTER TABLE `casemessages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cases`
--
ALTER TABLE `cases`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `deposits`
--
ALTER TABLE `deposits`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `faqheader`
--
ALTER TABLE `faqheader`
  MODIFY `ID` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `ID` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `ID` int(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pagevisit`
--
ALTER TABLE `pagevisit`
  MODIFY `ID` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=315;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `photo_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `records`
--
ALTER TABLE `records`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `recordscase`
--
ALTER TABLE `recordscase`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `recoverys`
--
ALTER TABLE `recoverys`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `redraws`
--
ALTER TABLE `redraws`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `site_info`
--
ALTER TABLE `site_info`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `testimony`
--
ALTER TABLE `testimony`
  MODIFY `ID` int(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trac_log`
--
ALTER TABLE `trac_log`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `ID` int(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
