--
-- Dumping data for table `actions`
--
INSERT INTO `actions` (`id`, `action_name`, `action_type`, `action_spec_id`, `created_at`, `updated_at`) VALUES
(1, 'Call RpTnx', 'Invoke', 1, '2022-08-02 15:00:00', '2022-08-02 15:00:00'),
(2, 'Call MemberRegistration', 'Invoke', 2, '2022-08-02 19:30:00', '2022-08-02 19:30:00'),
(3, 'Call RpTnx', 'Invoke', 3, '2022-08-02 19:30:00', '2022-08-02 19:30:00');


--
-- Dumping data for table `invokes`
--
INSERT INTO `invokes` (`id`, `url`, `method`, `content_type`, `auth_type`, `user`, `password`, `created_at`, `updated_at`) VALUES
(1, 'https://172.22.134.177/siebel/v1.0/service/LoyaltyProgramWebService/RegisterProcessTnx', 'Post', 'application/json', 'Basic', 'sadmin', 'sadmin21', '2022-08-02 15:00:00', '2022-08-02 15:00:00'),
(2, 'https://172.22.134.177/siebel/v1.0/service/LoyaltyMemberWebService/MemberRegisteration', 'Post', 'application/json', 'Basic', 'sadmin', 'sadmin21', '2022-08-02 15:00:00', '2022-08-02 15:00:00'),
(3, 'https://172.22.134.177/siebel/v1.0/service/LoyaltyProgramWebService/RegisterProcessTnx', 'Post', 'application/json', 'Basic', 'sadmin', 'sadmin21', '2022-08-02 15:00:00', '2022-08-02 15:00:00');

--
-- Dumping data for table `invoke_inputs`
--
INSERT INTO `invoke_inputs` (`id`, `invoke_id`, `input_name`, `input_type`, `literal_value`, `api_input_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'MembershipNumber', 'User', '', 'MembershipNumber', '2022-08-02 19:30:00', '2022-08-02 19:30:00'),
(2, 1, 'ProductName', 'Literal', '222', '', '2022-08-02 19:30:00', '2022-08-02 19:30:00'),
(3, 1, 'ProgramId', 'User', '', 'ProgramId', '2022-08-02 19:30:00', '2022-08-02 19:30:00'),
(4, 1, 'TransactionType', 'Literal', 'Accrual', '', '2022-08-02 19:30:00', '2022-08-02 19:30:00'),
(5, 1, 'TransactionSubType', 'Literal', 'Product', '', '2022-08-02 19:30:00', '2022-08-02 19:30:00'),
(6, 2, 'MobileNumber', 'User', '', 'MembershipNumber', '2022-08-02 19:30:00', '2022-08-02 19:30:00'),
(7, 2, 'ProgramId', 'User', '', 'ProgramId', '2022-08-02 19:30:00', '2022-08-02 19:30:00'),
(8, 2, 'ContactType', 'Literal', 'حقیقی', '', '2022-08-02 19:30:00', '2022-08-02 19:30:00'),
(9, 2, 'FirstName', 'Literal', 'محسن', '', '2022-08-02 19:30:00', '2022-08-02 19:30:00'),
(10, 2, 'PaymentType', 'Literal', '0', '', '2022-08-02 19:30:00', '2022-08-02 19:30:00'),
(11, 2, 'SimRegDate', 'Literal', '12/6/2021', '', '2022-08-02 19:30:00', '2022-08-02 19:30:00'),
(12, 2, 'RegType', 'Literal', 'CreateSubscriber', '', '2022-08-02 19:30:00', '2022-08-02 19:30:00'),
(13, 2, 'LastName', 'Literal', 'ملایری', '', '2022-08-02 19:30:00', '2022-08-02 19:30:00'),
(14, 3, 'MembershipNumber', 'User', '', 'MembershipNumber', '2022-08-02 19:30:00', '2022-08-02 19:30:00'),
(15, 3, 'ProductName', 'Literal', '222', '', '2022-08-02 19:30:00', '2022-08-02 19:30:00'),
(16, 3, 'ProgramId', 'User', '', 'ProgramId', '2022-08-02 19:30:00', '2022-08-02 19:30:00'),
(17, 3, 'TransactionType', 'Literal', 'Accrual', '', '2022-08-02 19:30:00', '2022-08-02 19:30:00'),
(18, 3, 'TransactionSubType', 'Literal', 'Product', '', '2022-08-02 19:30:00', '2022-08-02 19:30:00');

--
-- Dumping data for table `flows`
--
INSERT INTO `flows` (`id`, `flow_name`, `created_at`, `updated_at`) VALUES
(1, 'AutoRegister', '2022-08-02 19:30:00', '2022-08-02 19:30:00');


--
-- Dumping data for table `flow_nodes`
--
INSERT INTO `flow_nodes` (`id`, `flow_id`, `node_type`, `node_seq`, `node_spec_id`, `created_at`, `updated_at`) VALUES
(0, 1, 'Action', 0, 1, '2022-08-02 15:00:00', '2022-08-02 15:00:00'),
(1, 1, 'Decision', 1, 1, '2022-08-02 15:00:00', '2022-08-02 15:00:00'),
(2, 1, 'Action', 2, 2, '2022-08-02 19:30:00', '2022-08-02 19:30:00'),
(3, 1, 'Decision', 3, 2, '2022-08-02 15:00:00', '2022-08-02 15:00:00'),
(4, 1, 'Action', 4, 3, '2022-08-02 19:30:00', '2022-08-02 19:30:00');


--
-- Dumping data for table `decisions`
--
INSERT INTO `decisions` (`id`, `decision_name`, `flow_node_id`, `prop_name`, `decision_type`, `prop_value`, `created_at`, `updated_at`) VALUES
(1, 'Check RpTnx ResponseCode', 0, 'ResponseCode', 'Equal', '-105', '2022-08-02 19:30:00', '2022-08-02 19:30:00'),
(2, 'Check MemberRegistration ResponseCode', 2, 'ResponseCode', 'Equal', '0', '2022-08-02 19:30:00', '2022-08-02 19:30:00');
