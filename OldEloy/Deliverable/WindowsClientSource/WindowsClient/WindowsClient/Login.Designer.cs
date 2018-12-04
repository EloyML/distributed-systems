namespace WindowsClient
{
    partial class Login
    {
        /// <summary>
        /// Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Clean up any resources being used.
        /// </summary>
        /// <param name="disposing">true if managed resources should be disposed; otherwise, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Windows Form Designer generated code

        /// <summary>
        /// Required method for Designer support - do not modify
        /// the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            this.loginButton = new System.Windows.Forms.Button();
            this.registerButton = new System.Windows.Forms.Button();
            this.usernameInput = new System.Windows.Forms.TextBox();
            this.passwordInput = new System.Windows.Forms.TextBox();
            this.label1 = new System.Windows.Forms.Label();
            this.label2 = new System.Windows.Forms.Label();
            this.groupBox1 = new System.Windows.Forms.GroupBox();
            this.loginStatus = new System.Windows.Forms.Label();
            this.datePicker = new System.Windows.Forms.MonthCalendar();
            this.Date = new System.Windows.Forms.Label();
            this.label4 = new System.Windows.Forms.Label();
            this.timePicker = new System.Windows.Forms.ComboBox();
            this.getEventArea = new System.Windows.Forms.GroupBox();
            this.label6 = new System.Windows.Forms.Label();
            this.label5 = new System.Windows.Forms.Label();
            this.eventLocationInput = new System.Windows.Forms.TextBox();
            this.eventInfoInput = new System.Windows.Forms.TextBox();
            this.groupBox2 = new System.Windows.Forms.GroupBox();
            this.createEventButton = new System.Windows.Forms.Button();
            this.label3 = new System.Windows.Forms.Label();
            this.eventDisplay = new System.Windows.Forms.RichTextBox();
            this.getEventButton = new System.Windows.Forms.Button();
            this.groupBox1.SuspendLayout();
            this.getEventArea.SuspendLayout();
            this.groupBox2.SuspendLayout();
            this.SuspendLayout();
            // 
            // loginButton
            // 
            this.loginButton.Location = new System.Drawing.Point(157, 42);
            this.loginButton.Name = "loginButton";
            this.loginButton.Size = new System.Drawing.Size(75, 27);
            this.loginButton.TabIndex = 0;
            this.loginButton.Text = "Log In";
            this.loginButton.UseVisualStyleBackColor = true;
            this.loginButton.Click += new System.EventHandler(this.button1_Click);
            // 
            // registerButton
            // 
            this.registerButton.Location = new System.Drawing.Point(157, 82);
            this.registerButton.Name = "registerButton";
            this.registerButton.Size = new System.Drawing.Size(75, 27);
            this.registerButton.TabIndex = 1;
            this.registerButton.Text = "Register";
            this.registerButton.UseVisualStyleBackColor = true;
            this.registerButton.Click += new System.EventHandler(this.registerButton_Click);
            // 
            // usernameInput
            // 
            this.usernameInput.Location = new System.Drawing.Point(22, 54);
            this.usernameInput.Name = "usernameInput";
            this.usernameInput.Size = new System.Drawing.Size(103, 22);
            this.usernameInput.TabIndex = 2;
            // 
            // passwordInput
            // 
            this.passwordInput.Location = new System.Drawing.Point(22, 99);
            this.passwordInput.Name = "passwordInput";
            this.passwordInput.Size = new System.Drawing.Size(103, 22);
            this.passwordInput.TabIndex = 3;
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.Location = new System.Drawing.Point(19, 34);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(73, 17);
            this.label1.TabIndex = 4;
            this.label1.Text = "Username";
            this.label1.Click += new System.EventHandler(this.label1_Click);
            // 
            // label2
            // 
            this.label2.AutoSize = true;
            this.label2.Location = new System.Drawing.Point(19, 79);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(69, 17);
            this.label2.TabIndex = 5;
            this.label2.Text = "Password";
            // 
            // groupBox1
            // 
            this.groupBox1.Controls.Add(this.loginStatus);
            this.groupBox1.Controls.Add(this.loginButton);
            this.groupBox1.Controls.Add(this.registerButton);
            this.groupBox1.Location = new System.Drawing.Point(12, 12);
            this.groupBox1.Name = "groupBox1";
            this.groupBox1.Size = new System.Drawing.Size(243, 147);
            this.groupBox1.TabIndex = 6;
            this.groupBox1.TabStop = false;
            this.groupBox1.Text = "User Login and Registration";
            // 
            // loginStatus
            // 
            this.loginStatus.AutoSize = true;
            this.loginStatus.Location = new System.Drawing.Point(10, 116);
            this.loginStatus.Name = "loginStatus";
            this.loginStatus.Size = new System.Drawing.Size(0, 17);
            this.loginStatus.TabIndex = 1;
            this.loginStatus.Click += new System.EventHandler(this.label3_Click);
            // 
            // datePicker
            // 
            this.datePicker.Location = new System.Drawing.Point(9, 42);
            this.datePicker.MaxSelectionCount = 1;
            this.datePicker.Name = "datePicker";
            this.datePicker.TabIndex = 8;
            // 
            // Date
            // 
            this.Date.AutoSize = true;
            this.Date.Location = new System.Drawing.Point(6, 18);
            this.Date.Name = "Date";
            this.Date.Size = new System.Drawing.Size(38, 17);
            this.Date.TabIndex = 9;
            this.Date.Text = "Date";
            // 
            // label4
            // 
            this.label4.AutoSize = true;
            this.label4.Location = new System.Drawing.Point(20, 258);
            this.label4.Name = "label4";
            this.label4.Size = new System.Drawing.Size(39, 17);
            this.label4.TabIndex = 10;
            this.label4.Text = "Time";
            this.label4.Click += new System.EventHandler(this.label4_Click);
            // 
            // timePicker
            // 
            this.timePicker.FormattingEnabled = true;
            this.timePicker.Items.AddRange(new object[] {
            "00:00",
            "00:30",
            "01:00",
            "01:30",
            "02:00",
            "02:30",
            "03:00",
            "03:30",
            "04:00",
            "04:30",
            "05:00",
            "05:30",
            "06:00",
            "06:30",
            "07:00",
            "07:30",
            "08:00",
            "08.30",
            "09:00",
            "09:30",
            "10:00",
            "10:30",
            "11:00",
            "11:30",
            "12:00",
            "12:30",
            "13:00",
            "13:30",
            "14:00",
            "14:30",
            "15:00",
            "15:30",
            "16:00",
            "16:30",
            "17:00",
            "17:30",
            "18:00",
            "18:30",
            "19:00",
            "19:30",
            "20:00",
            "20:30",
            "21:00",
            "21:30",
            "22:00",
            "22:30",
            "23:00",
            "23:30"});
            this.timePicker.Location = new System.Drawing.Point(23, 279);
            this.timePicker.Name = "timePicker";
            this.timePicker.Size = new System.Drawing.Size(121, 24);
            this.timePicker.TabIndex = 11;
            this.timePicker.SelectedIndexChanged += new System.EventHandler(this.timePicker_SelectedIndexChanged);
            // 
            // getEventArea
            // 
            this.getEventArea.Controls.Add(this.label6);
            this.getEventArea.Controls.Add(this.label5);
            this.getEventArea.Controls.Add(this.eventLocationInput);
            this.getEventArea.Controls.Add(this.eventInfoInput);
            this.getEventArea.Controls.Add(this.groupBox2);
            this.getEventArea.Controls.Add(this.label3);
            this.getEventArea.Controls.Add(this.eventDisplay);
            this.getEventArea.Controls.Add(this.getEventButton);
            this.getEventArea.Controls.Add(this.timePicker);
            this.getEventArea.Controls.Add(this.datePicker);
            this.getEventArea.Controls.Add(this.label4);
            this.getEventArea.Controls.Add(this.Date);
            this.getEventArea.Location = new System.Drawing.Point(261, 12);
            this.getEventArea.Name = "getEventArea";
            this.getEventArea.Size = new System.Drawing.Size(668, 458);
            this.getEventArea.TabIndex = 12;
            this.getEventArea.TabStop = false;
            this.getEventArea.Text = "Event Manager";
            this.getEventArea.Enter += new System.EventHandler(this.groupBox2_Enter);
            // 
            // label6
            // 
            this.label6.AutoSize = true;
            this.label6.Location = new System.Drawing.Point(20, 383);
            this.label6.Name = "label6";
            this.label6.Size = new System.Drawing.Size(62, 17);
            this.label6.TabIndex = 18;
            this.label6.Text = "Location";
            // 
            // label5
            // 
            this.label5.AutoSize = true;
            this.label5.Location = new System.Drawing.Point(20, 338);
            this.label5.Name = "label5";
            this.label5.Size = new System.Drawing.Size(71, 17);
            this.label5.TabIndex = 17;
            this.label5.Text = "Event Info";
            // 
            // eventLocationInput
            // 
            this.eventLocationInput.Location = new System.Drawing.Point(23, 403);
            this.eventLocationInput.Name = "eventLocationInput";
            this.eventLocationInput.Size = new System.Drawing.Size(124, 22);
            this.eventLocationInput.TabIndex = 16;
            this.eventLocationInput.TextChanged += new System.EventHandler(this.textBox2_TextChanged);
            // 
            // eventInfoInput
            // 
            this.eventInfoInput.Location = new System.Drawing.Point(23, 358);
            this.eventInfoInput.Name = "eventInfoInput";
            this.eventInfoInput.Size = new System.Drawing.Size(124, 22);
            this.eventInfoInput.TabIndex = 15;
            // 
            // groupBox2
            // 
            this.groupBox2.Controls.Add(this.createEventButton);
            this.groupBox2.Location = new System.Drawing.Point(9, 309);
            this.groupBox2.Name = "groupBox2";
            this.groupBox2.Size = new System.Drawing.Size(276, 137);
            this.groupBox2.TabIndex = 20;
            this.groupBox2.TabStop = false;
            this.groupBox2.Text = "Create New Event";
            // 
            // createEventButton
            // 
            this.createEventButton.Location = new System.Drawing.Point(166, 61);
            this.createEventButton.Name = "createEventButton";
            this.createEventButton.Size = new System.Drawing.Size(96, 42);
            this.createEventButton.TabIndex = 19;
            this.createEventButton.Text = "Create event";
            this.createEventButton.UseVisualStyleBackColor = true;
            this.createEventButton.Click += new System.EventHandler(this.button1_Click_1);
            // 
            // label3
            // 
            this.label3.AutoSize = true;
            this.label3.Location = new System.Drawing.Point(320, 17);
            this.label3.Name = "label3";
            this.label3.Size = new System.Drawing.Size(51, 17);
            this.label3.TabIndex = 14;
            this.label3.Text = "Events";
            // 
            // eventDisplay
            // 
            this.eventDisplay.Location = new System.Drawing.Point(323, 44);
            this.eventDisplay.Name = "eventDisplay";
            this.eventDisplay.Size = new System.Drawing.Size(334, 402);
            this.eventDisplay.TabIndex = 13;
            this.eventDisplay.Text = "";
            // 
            // getEventButton
            // 
            this.getEventButton.Location = new System.Drawing.Point(175, 279);
            this.getEventButton.Name = "getEventButton";
            this.getEventButton.Size = new System.Drawing.Size(96, 24);
            this.getEventButton.TabIndex = 12;
            this.getEventButton.Text = "Get events";
            this.getEventButton.UseVisualStyleBackColor = true;
            this.getEventButton.Click += new System.EventHandler(this.getEventButton_Click);
            // 
            // Login
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(8F, 16F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(940, 480);
            this.Controls.Add(this.label2);
            this.Controls.Add(this.label1);
            this.Controls.Add(this.passwordInput);
            this.Controls.Add(this.usernameInput);
            this.Controls.Add(this.groupBox1);
            this.Controls.Add(this.getEventArea);
            this.Name = "Login";
            this.Text = "Login";
            this.Load += new System.EventHandler(this.Login_Load);
            this.groupBox1.ResumeLayout(false);
            this.groupBox1.PerformLayout();
            this.getEventArea.ResumeLayout(false);
            this.getEventArea.PerformLayout();
            this.groupBox2.ResumeLayout(false);
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.Button loginButton;
        private System.Windows.Forms.Button registerButton;
        private System.Windows.Forms.TextBox usernameInput;
        private System.Windows.Forms.TextBox passwordInput;
        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.GroupBox groupBox1;
        private System.Windows.Forms.Label loginStatus;
        private System.Windows.Forms.MonthCalendar datePicker;
        private System.Windows.Forms.Label Date;
        private System.Windows.Forms.Label label4;
        private System.Windows.Forms.ComboBox timePicker;
        private System.Windows.Forms.GroupBox getEventArea;
        private System.Windows.Forms.Button getEventButton;
        private System.Windows.Forms.Label label3;
        private System.Windows.Forms.RichTextBox eventDisplay;
        private System.Windows.Forms.Button createEventButton;
        private System.Windows.Forms.Label label6;
        private System.Windows.Forms.Label label5;
        private System.Windows.Forms.TextBox eventLocationInput;
        private System.Windows.Forms.TextBox eventInfoInput;
        private System.Windows.Forms.GroupBox groupBox2;
    }
}